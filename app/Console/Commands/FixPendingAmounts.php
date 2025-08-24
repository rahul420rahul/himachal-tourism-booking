<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;

class FixPendingAmounts extends Command
{
    protected $signature = 'bookings:fix-pending-amounts';
    protected $description = 'Calculate and update pending amounts for all bookings';

    public function handle()
    {
        $this->info('Fixing pending amounts for all bookings...');
        
        $bookings = Booking::all();
        $count = 0;
        
        foreach ($bookings as $booking) {
            $oldPending = $booking->pending_amount;
            
            // Calculate based on payment status
            if ($booking->payment_status === 'paid') {
                // Fully paid
                $booking->pending_amount = 0;
            } elseif ($booking->payment_status === 'partial') {
                // Partial payment - advance paid, rest pending
                $booking->pending_amount = $booking->final_amount - $booking->advance_amount;
            } elseif ($booking->payment_status === 'pending') {
                // No payment yet
                $booking->pending_amount = $booking->final_amount;
            }
            
            // Also ensure package_price is set
            if (empty($booking->package_price) && $booking->package) {
                $booking->package_price = $booking->package->price ?? $booking->final_amount;
            }
            
            if ($oldPending != $booking->pending_amount) {
                $booking->save();
                $count++;
                $this->info("Updated booking #{$booking->booking_number}: Pending amount = ₹{$booking->pending_amount}");
            }
        }
        
        $this->info("Completed! Updated {$count} bookings.");
        
        return Command::SUCCESS;
    }
}
