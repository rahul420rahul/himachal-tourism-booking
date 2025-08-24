<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
   /**
    * Show the privacy policy page
    */
   public function privacy()
   {
       return view('pages.privacy', [
           'title' => 'Privacy Policy',
           'metaDescription' => 'Read our privacy policy to understand how we collect, use, and protect your personal information.',
           'lastUpdated' => '2025-01-01'
       ]);
   }

   /**
    * Show the terms and conditions page
    */
   public function terms()
   {
       return view('pages.terms', [
           'title' => 'Terms & Conditions',
           'metaDescription' => 'Terms and conditions for using MyBirBilling paragliding services.',
           'lastUpdated' => '2025-01-01'
       ]);
   }

   /**
    * Show the safety guidelines page
    */
   public function safety()
   {
       return view('pages.safety', [
           'title' => 'Safety Guidelines',
           'metaDescription' => 'Important safety guidelines and requirements for paragliding activities.',
           'lastUpdated' => '2025-01-01'
       ]);
   }

   /**
    * Show the refund policy page
    */
   public function refund()
   {
       return view('pages.refund', [
           'title' => 'Refund Policy',
           'metaDescription' => 'Our refund and cancellation policy for paragliding bookings.',
           'lastUpdated' => '2025-01-01'
       ]);
   }

   /**
    * Show the about us page
    */
   public function about()
   {
       return view('pages.about', [
           'title' => 'About Us',
           'metaDescription' => 'Learn about MyBirBilling - your trusted paragliding adventure partner in Himachal Pradesh.',
           'teamMembers' => $this->getTeamMembers(),
           'achievements' => $this->getAchievements()
       ]);
   }

   /**
    * Show the contact page
    */
   public function contact()
   {
       return view('pages.contact', [
           'title' => 'Contact Us',
           'metaDescription' => 'Get in touch with us for paragliding bookings and inquiries.',
           'officeHours' => 'Mon-Sun: 9:00 AM - 6:00 PM',
           'emergencyContact' => '+91-9736696260'
       ]);
   }

   /**
    * Get team members data
    */
   private function getTeamMembers()
   {
       return [
           [
               'name' => 'Captain Rajesh Kumar',
               'position' => 'Chief Instructor',
               'experience' => '15+ years',
               'certifications' => ['APPI Certified', 'Rescue Specialist']
           ],
           [
               'name' => 'Priya Sharma',
               'position' => 'Safety Officer',
               'experience' => '8+ years',
               'certifications' => ['First Aid Certified', 'Weather Specialist']
           ]
       ];
   }

   /**
    * Get achievements data
    */
   private function getAchievements()
   {
       return [
           [
               'title' => 'Zero Accident Record',
               'description' => '5000+ safe flights completed',
               'year' => '2020-2025'
           ],
           [
               'title' => 'Best Adventure Company',
               'description' => 'Himachal Tourism Award',
               'year' => '2024'
           ],
           [
               'title' => 'Certified Training Center',
               'description' => 'APPI Approved School',
               'year' => '2022'
           ]
       ];
   }

   /**
    * Handle contact form submission
    */
   public function submitContact(Request $request)
   {
       $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|email|max:255',
           'phone' => 'required|string|max:20',
           'message' => 'required|string|max:1000',
           'subject' => 'nullable|string|max:255'
       ]);

       // Store contact inquiry
       try {
           \App\Models\ContactInquiry::create([
               'name' => $request->name,
               'email' => $request->email,
               'phone' => $request->phone,
               'subject' => $request->subject ?? 'General Inquiry',
               'message' => $request->message,
               'status' => 'unread',
               'source' => 'website'
           ]);

           return back()->with('success', 'Thank you for your message. We will get back to you soon!');
       } catch (\Exception $e) {
           return back()->with('error', 'Sorry, there was an error sending your message. Please try again.');
       }
   }

   /**
    * Show FAQ page
    */
   public function faq()
   {
       $faqs = [
           [
               'question' => 'Is paragliding safe for beginners?',
               'answer' => 'Yes, tandem paragliding with certified instructors is very safe. We maintain the highest safety standards.'
           ],
           [
               'question' => 'What is the minimum age requirement?',
               'answer' => 'The minimum age is 16 years. Participants under 18 need parental consent.'
           ],
           [
               'question' => 'What should I wear for paragliding?',
               'answer' => 'Wear comfortable clothes, closed shoes, and bring sunglasses. We provide all safety equipment.'
           ],
           [
               'question' => 'Can flights be cancelled due to weather?',
               'answer' => 'Yes, safety is our priority. Flights may be cancelled or rescheduled due to weather conditions.'
           ]
       ];

       return view('pages.faq', [
           'title' => 'Frequently Asked Questions',
           'metaDescription' => 'Common questions about paragliding with MyBirBilling.',
           'faqs' => $faqs
       ]);
   }
}