<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $packages = Package::where('is_active', true)
                          ->orderBy('featured', 'desc')
                          ->limit(6)
                          ->get();
                          
        $testimonials = Testimonial::where('is_approved', true)
                                 ->orderBy('created_at', 'desc')
                                 ->limit(6)
                                 ->get();
        
        return view('home', compact('packages', 'testimonials'));
    }
}
