<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Package;

class ReactBookingController extends Controller
{
    public function getPackages()
    {
        $packages = Package::where('is_active', true)->get();
        return response()->json($packages);
    }
}
