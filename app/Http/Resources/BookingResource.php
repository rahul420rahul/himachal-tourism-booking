<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'booking_number' => $this->booking_number,
            'user_id' => $this->user_id,
            'package_id' => $this->package_id,
            'booking_date' => $this->booking_date,
            'time_slot' => $this->time_slot,
            'participants' => $this->participants,
            'package_price' => $this->package_price,
            'status' => $this->status,
            'payment_status' => $this->payment_status,
        ];
    }
}
