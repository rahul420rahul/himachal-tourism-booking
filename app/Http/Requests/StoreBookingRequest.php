<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'package_id' => 'required|exists:packages,id',
            'booking_date' => 'required|date|after:today',
            'time_slot' => 'required|string',
            'participants' => 'required|integer|min:1|max:10',
            'guest_name' => 'required_without:user_id|string|max:255',
            'guest_email' => 'required_without:user_id|email',
            'guest_phone' => 'required_without:user_id|string|max:20',
            'special_requests' => 'nullable|string|max:500',
            'participant_details' => 'nullable|array',
            'payment_method' => 'required|in:razorpay,cash',
        ];
    }

    public function messages()
    {
        return [
            'booking_date.after' => 'Booking date must be in the future',
            'package_id.exists' => 'Selected package does not exist',
        ];
    }
}
