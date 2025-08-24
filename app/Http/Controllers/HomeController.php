<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $packages = Package::where('is_active', true)
                        ->orderBy('featured', 'desc')
                        ->limit(6)
                        ->get();
        } catch (\Exception $e) {
            $packages = collect();
        }
        
        try {
            $testimonials = Testimonial::where('is_active', true)
                            ->limit(3)
                            ->get();
        } catch (\Exception $e) {
            $testimonials = collect();
        }
        
        return view('home', compact('packages', 'testimonials'));
    }
}
