<?php
namespace App\Repositories\Eloquent;

use App\Models\Booking;
use Carbon\Carbon;

class BookingRepository extends BaseRepository
{
    public function __construct(Booking $model)
    {
        parent::__construct($model);
    }

    public function getBookingsByDate($date)
    {
        return $this->model->whereDate('booking_date', $date)->get();
    }

    public function getUpcomingBookings($userId = null)
    {
        $query = $this->model->where('booking_date', '>=', Carbon::today());
        
        if ($userId) {
            $query->where('user_id', $userId);
        }
        
        return $query->orderBy('booking_date')->get();
    }

    public function generateBookingNumber()
    {
        return 'BRB' . date('Ymd') . strtoupper(substr(uniqid(), -6));
    }
}
