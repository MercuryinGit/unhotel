<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Kamar;
use App\Models\Promo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    public function search(Request $request)
    {
        $validated = $request->validate([
            'check_in' => 'nullable|required_with:check_out|date_format:Y-m-d|after_or_equal:today',
            'check_out' => 'nullable|required_with:check_in|date_format:Y-m-d|after:check_in',
            'guests' => 'nullable|integer|min:1|max:20',
            'promo_code' => 'nullable|string|max:30',
        ]);

        $filters = array_merge([
            'check_in' => null,
            'check_out' => null,
            'guests' => 1,
        ], $validated);

        $query = Kamar::query()
            ->where('status', 'tersedia')
            ->where('kapasitas', '>=', $filters['guests']);

        if ($filters['check_in'] && $filters['check_out']) {
            $query->availableBetween($filters['check_in'], $filters['check_out']);
        }

        $kamars = $query
            ->orderBy('harga_per_malam')
            ->paginate(8)
            ->withQueryString();

        return view('booking.search', compact('kamars', 'filters'));
    }

    public function showRoom(Request $request, Kamar $kamar)
    {
        $filters = $request->validate([
            'check_in' => 'nullable|required_with:check_out|date_format:Y-m-d|after_or_equal:today',
            'check_out' => 'nullable|required_with:check_in|date_format:Y-m-d|after:check_in',
            'guests' => 'nullable|integer|min:1|max:'.$kamar->kapasitas,
            'promo_code' => 'nullable|string|max:30',
        ]);

        return view('booking.room', compact('kamar', 'filters'));
    }

    public function create(Request $request, Kamar $kamar)
    {
        $filters = $request->validate([
            'check_in' => 'required|date_format:Y-m-d|after_or_equal:today',
            'check_out' => 'required|date_format:Y-m-d|after:check_in',
            'guests' => 'required|integer|min:1|max:'.$kamar->kapasitas,
            'promo_code' => 'nullable|string|max:30',
        ]);

        $available = Kamar::query()
            ->whereKey($kamar->getKey())
            ->availableBetween($filters['check_in'], $filters['check_out'])
            ->exists();

        if (! $available) {
            return redirect()->route('rooms.search', $filters)
                ->withErrors(['room' => 'Kamar ini baru saja dipesan. Silakan pilih kamar lain.']);
        }

        $promoCode = Str::upper(trim($filters['promo_code'] ?? ''));
        $promo = $promoCode ? $this->activePromo($promoCode) : null;

        if ($promoCode && ! $promo) {
            throw ValidationException::withMessages([
                'promo_code' => 'Kode promo tidak aktif atau tidak ditemukan.',
            ]);
        }

        $nights = Carbon::parse($filters['check_in'])->diffInDays(Carbon::parse($filters['check_out']));
        $subtotal = (float) $kamar->harga_per_malam * $nights;
        $discountAmount = $promo?->discountFor($subtotal) ?? 0;
        $totalAmount = $subtotal - $discountAmount;

        return view('booking.create', compact('kamar', 'filters', 'nights', 'promo', 'subtotal', 'discountAmount', 'totalAmount'));
    }

    public function store(Request $request, Kamar $kamar)
    {
        $data = $request->validate([
            'check_in' => 'required|date_format:Y-m-d|after_or_equal:today',
            'check_out' => 'required|date_format:Y-m-d|after:check_in',
            'guest_count' => 'required|integer|min:1|max:'.$kamar->kapasitas,
            'payment_method' => 'required|in:bank_transfer,pay_at_hotel',
            'promo_code' => 'nullable|string|max:30',
            'special_request' => 'nullable|string|max:500',
        ]);

        $data['promo_code'] = Str::upper(trim($data['promo_code'] ?? ''));

        $booking = DB::transaction(function () use ($data, $kamar, $request) {
            $lockedKamar = Kamar::query()
                ->lockForUpdate()
                ->findOrFail($kamar->getKey());

            $overlappingBooking = $lockedKamar->bookings()
                ->whereIn('status', ['pending', 'confirmed'])
                ->whereDate('check_in', '<', $data['check_out'])
                ->whereDate('check_out', '>', $data['check_in'])
                ->exists();

            if ($lockedKamar->status !== 'tersedia'
                || $data['guest_count'] > $lockedKamar->kapasitas
                || $overlappingBooking) {
                throw ValidationException::withMessages([
                    'room' => 'Kamar ini tidak lagi tersedia pada tanggal tersebut.',
                ]);
            }

            $nights = Carbon::parse($data['check_in'])->diffInDays(Carbon::parse($data['check_out']));
            $promo = $data['promo_code'] ? $this->activePromo($data['promo_code'], true) : null;

            if ($data['promo_code'] && ! $promo) {
                throw ValidationException::withMessages([
                    'promo_code' => 'Kode promo sudah tidak aktif. Silakan hapus kode promo dan coba lagi.',
                ]);
            }

            $subtotal = (float) $lockedKamar->harga_per_malam * $nights;
            $discountAmount = $promo?->discountFor($subtotal) ?? 0;

            return Booking::create([
                'booking_code' => 'UHS-'.now()->format('ymd').'-'.Str::upper(Str::random(6)),
                'user_id' => $request->user()->id,
                'kamar_id' => $lockedKamar->id,
                'promo_id' => $promo?->id,
                'promo_code' => $promo?->kode,
                'check_in' => $data['check_in'],
                'check_out' => $data['check_out'],
                'guest_count' => $data['guest_count'],
                'total_amount' => $subtotal - $discountAmount,
                'discount_amount' => $discountAmount,
                'payment_method' => $data['payment_method'],
                'status' => 'pending',
                'payment_status' => 'pending',
                'special_request' => $data['special_request'] ?? null,
            ]);
        });

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Permintaan pemesanan berhasil dibuat.');
    }

    public function index(Request $request)
    {
        $bookings = $request->user()
            ->bookings()
            ->with('kamar')
            ->latest()
            ->paginate(10);

        return view('booking.index', compact('bookings'));
    }

    public function show(Request $request, Booking $booking)
    {
        abort_unless($booking->user_id === $request->user()->id, 403);

        $booking->load('kamar');

        return view('booking.show', compact('booking'));
    }

    public function cancel(Request $request, Booking $booking)
    {
        abort_unless($booking->user_id === $request->user()->id, 403);

        if ($booking->status !== 'pending' || $booking->payment_status !== 'pending') {
            return back()->with('error', 'Pemesanan ini tidak dapat dibatalkan dari akun Anda.');
        }

        $booking->update(['status' => 'cancelled']);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Pemesanan berhasil dibatalkan.');
    }

    private function activePromo(string $code, bool $lock = false): ?Promo
    {
        $query = Promo::query()
            ->whereRaw('upper(kode) = ?', [$code])
            ->active();

        if ($lock) {
            $query->lockForUpdate();
        }

        return $query->first();
    }
}
