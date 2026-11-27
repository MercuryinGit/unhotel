<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Fasilitas;
use App\Models\Kamar;
use App\Models\Promo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_room_search_excludes_overlapping_bookings_but_allows_back_to_back_stays(): void
    {
        $kamar = $this->createKamar();
        $checkIn = now()->addDays(4)->toDateString();
        $checkOut = now()->addDays(6)->toDateString();

        $this->createBooking($kamar, User::factory()->create(), $checkIn, $checkOut);

        $this->get(route('rooms.search', [
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'guests' => 2,
        ]))->assertOk()->assertDontSee('Kamar 101');

        $this->get(route('rooms.search', [
            'check_in' => $checkOut,
            'check_out' => now()->addDays(7)->toDateString(),
            'guests' => 2,
        ]))->assertOk()->assertSee('Kamar 101');
    }

    public function test_authenticated_guest_can_create_a_booking_with_the_calculated_total(): void
    {
        $user = User::factory()->create();
        $kamar = $this->createKamar();
        $checkIn = now()->addDays(3)->toDateString();
        $checkOut = now()->addDays(5)->toDateString();

        $this->actingAs($user)
            ->post(route('booking.store', $kamar), [
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'guest_count' => 2,
                'payment_method' => 'bank_transfer',
                'special_request' => 'Kamar bebas rokok',
            ])
            ->assertRedirect();

        $booking = Booking::firstOrFail();

        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'kamar_id' => $kamar->id,
            'total_amount' => 900000,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);
        $this->assertSame($checkIn, $booking->check_in->format('Y-m-d'));
        $this->assertSame($checkOut, $booking->check_out->format('Y-m-d'));
    }

    public function test_booking_checkout_requires_login_and_booking_details_are_private(): void
    {
        $kamar = $this->createKamar();
        $checkIn = now()->addDays(3)->toDateString();
        $checkOut = now()->addDays(4)->toDateString();

        $this->get(route('booking.create', [
            'kamar' => $kamar,
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'guests' => 1,
        ]))->assertRedirect(route('login'));

        $booking = $this->createBooking($kamar, User::factory()->create(), $checkIn, $checkOut);

        $this->actingAs(User::factory()->create())
            ->get(route('bookings.show', $booking))
            ->assertForbidden();
    }

    public function test_guest_can_cancel_pending_booking_and_release_the_room_dates(): void
    {
        $user = User::factory()->create();
        $kamar = $this->createKamar();
        $checkIn = now()->addDays(3)->toDateString();
        $checkOut = now()->addDays(4)->toDateString();
        $booking = $this->createBooking($kamar, $user, $checkIn, $checkOut);

        $this->actingAs($user)
            ->patch(route('bookings.cancel', $booking))
            ->assertRedirect(route('bookings.show', $booking));

        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'cancelled',
        ]);

        $this->get(route('rooms.search', [
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'guests' => 2,
        ]))->assertOk()->assertSee('Kamar 101');
    }

    public function test_admin_can_confirm_a_booking_and_update_payment_status(): void
    {
        $booking = $this->createBooking(
            $this->createKamar(),
            User::factory()->create(),
            now()->addDays(3)->toDateString(),
            now()->addDays(4)->toDateString()
        );
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->patch(route('admin.bookings.update', $booking), [
                'status' => 'confirmed',
                'payment_status' => 'paid',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'confirmed',
            'payment_status' => 'paid',
        ]);
    }

    public function test_active_promo_discount_is_saved_with_the_booking(): void
    {
        $user = User::factory()->create();
        $kamar = $this->createKamar();
        $promo = Promo::create([
            'judul' => 'Diskon sepuluh persen',
            'kode' => 'STAY10',
            'deskripsi' => 'Promo pengujian.',
            'diskon_persen' => 10,
            'mulai_pada' => now()->subDay()->toDateString(),
            'berakhir_pada' => now()->addDay()->toDateString(),
            'aktif' => true,
        ]);
        $checkIn = now()->addDays(3)->toDateString();
        $checkOut = now()->addDays(5)->toDateString();

        $this->actingAs($user)
            ->post(route('booking.store', $kamar), [
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'guest_count' => 2,
                'payment_method' => 'bank_transfer',
                'promo_code' => 'stay10',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'promo_id' => $promo->id,
            'promo_code' => 'STAY10',
            'discount_amount' => 90000,
            'total_amount' => 810000,
        ]);
    }

    public function test_user_can_update_profile_without_changing_their_role(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)
            ->patch(route('profile.update'), [
                'name' => 'Nama Baru',
                'email' => $user->email,
                'role' => 'admin',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Nama Baru',
            'role' => 'user',
        ]);
    }

    public function test_inactive_facilities_are_hidden_from_the_public_list(): void
    {
        Fasilitas::create([
            'nama' => 'Wi-Fi gratis',
            'ikon' => 'WF',
            'deskripsi' => 'Internet untuk tamu.',
            'aktif' => true,
        ]);
        Fasilitas::create([
            'nama' => 'Fasilitas internal',
            'ikon' => 'IN',
            'deskripsi' => 'Tidak ditampilkan ke tamu.',
            'aktif' => false,
        ]);

        $this->get(route('facilities.index'))
            ->assertOk()
            ->assertSee('Wi-Fi gratis')
            ->assertDontSee('Fasilitas internal');
    }

    public function test_admin_can_update_a_facility(): void
    {
        $facility = Fasilitas::create([
            'nama' => 'Wi-Fi',
            'ikon' => 'WF',
            'deskripsi' => 'Internet untuk tamu.',
            'aktif' => true,
        ]);
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->put(route('admin.fasilitas.update', $facility), [
                'nama' => 'Wi-Fi gratis',
                'ikon' => 'WF',
                'deskripsi' => 'Internet tersedia untuk tamu.',
                'aktif' => 1,
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('fasilitas', [
            'id' => $facility->id,
            'nama' => 'Wi-Fi gratis',
        ]);
    }

    private function createKamar(): Kamar
    {
        return Kamar::create([
            'nomor_kamar' => '101',
            'tipe_kamar' => 'Standar',
            'harga_per_malam' => 450000,
            'kapasitas' => 2,
            'status' => 'tersedia',
            'deskripsi' => 'Kamar nyaman',
        ]);
    }

    private function createBooking(Kamar $kamar, User $user, string $checkIn, string $checkOut): Booking
    {
        return Booking::create([
            'booking_code' => 'TEST-'.uniqid(),
            'user_id' => $user->id,
            'kamar_id' => $kamar->id,
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'guest_count' => 2,
            'total_amount' => 900000,
            'payment_method' => 'bank_transfer',
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);
    }
}
