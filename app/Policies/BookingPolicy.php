<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Booking;

class BookingPolicy
{
    public function view(User $user, Booking $booking)
    {
        // User can view their own bookings
        return $user->id === $booking->user_id;
    }

    public function update(User $user, Booking $booking)
    {
        return $user->id === $booking->user_id && $booking->status !== 'cancelled';
    }

    public function delete(User $user, Booking $booking)
    {
        return $user->id === $booking->user_id && $booking->payment_status !== 'paid';
    }
}
