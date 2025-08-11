<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::where('is_active', true)
                          ->orderBy('featured', 'desc')
                          ->orderBy('created_at', 'desc')
                          ->paginate(12);
                          
        return view('packages.index', compact('packages'));
    }
    
    public function show(Package $package)
    {
        return view('packages.show', compact('package'));
    }
}
