<?php
namespace App\Jobs;

use App\Models\Booking;
use App\Mail\BookingConfirmation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendBookingConfirmation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function handle()
    {
        $email = $this->booking->user 
            ? $this->booking->user->email 
            : $this->booking->guest_email;

        Mail::to($email)->send(new BookingConfirmation($this->booking));
    }
}
