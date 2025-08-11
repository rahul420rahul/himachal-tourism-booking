<?php

namespace App\Http\Controllers;

use App\Models\ContactInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'preferred_contact' => 'in:email,phone,whatsapp'
        ]);

        // Save to database
        ContactInquiry::create($validated);

        return back()->with('success', 'Thank you! Your message has been sent successfully. We will get back to you soon.');
    }
}
