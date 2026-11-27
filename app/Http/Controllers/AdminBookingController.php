<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Kamar;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function dashboard()
    {
        $summary = [
            'rooms' => Kamar::count(),
            'available_rooms' => Kamar::where('status', 'tersedia')->count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
        ];

        $recentBookings = Booking::query()
            ->with(['user', 'kamar'])
            ->latest()
            ->limit(6)
            ->get();

        return view('admin.dashboard', compact('summary', 'recentBookings'));
    }

    public function index(Request $request)
    {
        $filters = $request->validate([
            'status' => 'nullable|in:pending,confirmed,completed,cancelled',
        ]);

        $bookings = Booking::query()
            ->with(['user', 'kamar'])
            ->when($filters['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.bookings.index', compact('bookings', 'filters'));
    }

    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'payment_status' => 'required|in:pending,paid',
        ]);

        $booking->update($data);

        return back()->with('success', 'Status pemesanan berhasil diperbarui.');
    }
}
