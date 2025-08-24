<?php
// tests/Feature/BookingControllerTest.php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Package;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_booking()
    {
        $user = User::factory()->create();
        $package = Package::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/v1/bookings', [
            'customer_name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'package_id' => $package->id,
            'booking_date' => now()->addDays(7)->toDateString(),
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('bookings', [
            'customer_name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
    }

    public function test_booking_validation_fails()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/v1/bookings', [
            'customer_name' => '',
            'email' => 'invalid-email',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['customer_name', 'email']);
    }

    public function test_can_view_booking()
    {
        $booking = Booking::factory()->create();

        $response = $this->getJson("/api/v1/bookings/{$booking->id}");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'customer_name',
                'email',
                'phone',
                'booking_date',
                'status',
            ]
        ]);
    }
}
