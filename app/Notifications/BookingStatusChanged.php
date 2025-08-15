<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BookingStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    protected $booking;
    protected $oldStatus;
    protected $newStatus;

    public function __construct(Booking $booking, $oldStatus, $newStatus)
    {
        $this->booking = $booking;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $subject = $this->getEmailSubject();
        $greeting = $this->getGreeting();
        $message = $this->getStatusMessage();

        return (new MailMessage)
                    ->subject($subject)
                    ->greeting($greeting)
                    ->line($message)
                    ->line("**Booking Details:**")
                    ->line("Booking Number: {$this->booking->booking_number}")
                    ->line("Package: {$this->booking->package->name}")
                    ->line("Date: " . \Carbon\Carbon::parse($this->booking->booking_date)->format('d M Y'))
                    ->line("Participants: {$this->booking->participants}")
                    ->when($this->newStatus === 'cancelled', function($mail) {
                        return $mail->line('**Cancellation Policy:**')
                                   ->line('• Full refund if cancelled 48+ hours before')
                                   ->line('• 50% refund if cancelled 24-48 hours before')
                                   ->line('• No refund if cancelled within 24 hours');
                    })
                    ->when($this->newStatus === 'confirmed', function($mail) {
                        return $mail->line('**What to bring:**')
                                   ->line('• Valid ID proof')
                                   ->line('• Comfortable clothes & closed shoes')
                                   ->line('• Arrive 30 minutes early');
                    })
                    ->action('View Booking', route('bookings.show', $this->booking->id))
                    ->line('Contact us at +91 98765 43210 for any queries.')
                    ->salutation('Safe Adventures, Bir Billing Team 🪂');
    }

    private function getEmailSubject()
    {
        switch ($this->newStatus) {
            case 'confirmed':
                return '✅ Booking Confirmed - ' . $this->booking->package->name;
            case 'cancelled':
                return '❌ Booking Cancelled - ' . $this->booking->package->name;
            case 'rescheduled':
                return '📅 Booking Rescheduled - ' . $this->booking->package->name;
            case 'completed':
                return '🎉 Adventure Completed - Thank You!';
            default:
                return '📧 Booking Update - ' . $this->booking->package->name;
        }
    }

    private function getGreeting()
    {
        return "Hello {$this->booking->customer_name}!";
    }

    private function getStatusMessage()
    {
        switch ($this->newStatus) {
            case 'confirmed':
                return "Great news! Your booking has been confirmed. Get ready for an amazing adventure at Bir Billing! 🪂";
                
            case 'cancelled':
                return "We're sorry to inform you that your booking has been cancelled. Our team will contact you regarding the refund process.";
                
            case 'rescheduled':
                return "Your booking has been rescheduled due to weather conditions or other circumstances. We'll contact you with the new date and time.";
                
            case 'completed':
                return "Thank you for choosing Bir Billing Adventures! We hope you had an amazing experience. Please share your feedback and photos with us!";
                
            case 'pending_payment':
                return "Your booking is confirmed but payment is still pending. Please complete the payment to secure your slot.";
                
            case 'weather_dependent':
                return "Your booking is weather dependent. We'll monitor conditions and notify you 24 hours before your scheduled date.";
                
            default:
                return "Your booking status has been updated from '{$this->oldStatus}' to '{$this->newStatus}'.";
        }
    }

    public function toArray($notifiable)
    {
        return [
            'booking_id' => $this->booking->id,
            'booking_number' => $this->booking->booking_number,
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
            'package_name' => $this->booking->package->name,
            'customer_name' => $this->booking->customer_name,
        ];
    }
}
