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
            'preferred_contact' => 'nullable|in:email,phone,whatsapp'
        ]);

        // Set default preferred contact if not provided
        $validated['preferred_contact'] = $validated['preferred_contact'] ?? 'email';

        try {
            // Save to database
            ContactInquiry::create($validated);

            return back()->with('success', 'Thank you! Your message has been sent successfully. We will get back to you within 2 hours during business hours.');

        } catch (\Exception $e) {
            return back()->with('error', 'Sorry, there was an error sending your message. Please try again or call us directly.');
        }
    }

    // Admin methods for managing contacts
    public function adminIndex()
    {
        $contacts = ContactInquiry::latest()->paginate(20);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function adminShow(ContactInquiry $contact)
    {
        $contact->markAsRead();
        return view('admin.contacts.show', compact('contact'));
    }

    public function markAsRead(ContactInquiry $contact)
    {
        $contact->update(['is_read' => true]);
        return back()->with('success', 'Contact marked as read.');
    }

    public function destroy(ContactInquiry $contact)
    {
        $contact->delete();
        return back()->with('success', 'Contact inquiry deleted successfully.');
    }
}
