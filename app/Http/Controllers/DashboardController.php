<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Booking;
use App\Models\Certificate;
use App\Models\Gallery;
use App\Models\FlightLog;

class DashboardController extends Controller
{
    public function index()
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $user = Auth::user();
        
        // Get user's bookings
        $myBookings = Booking::where('user_id', $user->id)
            ->with('package')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        
        // Get user's certificates - check if model exists
        $certificates = collect();
        if (class_exists('App\Models\Certificate')) {
            $certificates = Certificate::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
        }
        
        // Get user's gallery items
        $galleries = Gallery::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();
        
        // Pass all variables to the view
        return view('dashboard', compact('myBookings', 'certificates', 'galleries'));
    }

    public function gallery()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $galleries = Gallery::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            
        return view('dashboard.gallery', compact('galleries'));
    }

    public function uploadToGallery(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:jpg,jpeg,png,gif,mp4,avi,mov|max:10240'
        ]);

        $file = $request->file('file');
        $path = $file->store('gallery', 'public');

        $gallery = Gallery::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $path,
            'file_type' => $file->getMimeType(),
            'is_public' => $request->has('is_public') ? true : false
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully!');
    }

    public function deleteGalleryItem(Gallery $gallery)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Check if user owns this gallery item
        if ($gallery->user_id !== Auth::id()) {
            abort(403);
        }

        // Delete file from storage
        if (Storage::disk('public')->exists($gallery->file_path)) {
            Storage::disk('public')->delete($gallery->file_path);
        }

        $gallery->delete();

        return redirect()->back()->with('success', 'Item deleted successfully!');
    }

    public function certificates()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        if (!class_exists('App\Models\Certificate')) {
            return redirect()->route('dashboard')->with('error', 'Certificates feature not available');
        }
        
        $certificates = Certificate::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('dashboard.certificates', compact('certificates'));
    }

    public function uploadCertificate(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        if (!class_exists('App\Models\Certificate')) {
            return redirect()->route('dashboard')->with('error', 'Certificates feature not available');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'certificate_number' => 'nullable|string|max:100',
            'issue_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after:issue_date',
            'issuing_authority' => 'nullable|string|max:255',
            'certificate_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        $file = $request->file('certificate_file');
        $path = $file->store('certificates', 'public');

        Certificate::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'certificate_number' => $request->certificate_number,
            'issue_date' => $request->issue_date,
            'expiry_date' => $request->expiry_date,
            'issuing_authority' => $request->issuing_authority,
            'file_path' => $path,
            'verified' => false
        ]);

        return redirect()->back()->with('success', 'Certificate uploaded successfully!');
    }

    public function downloadCertificate($certificateId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        if (!class_exists('App\Models\Certificate')) {
            abort(404);
        }
        
        $certificate = Certificate::findOrFail($certificateId);
        
        // Check if user owns this certificate
        if ($certificate->user_id !== Auth::id()) {
            abort(403);
        }

        return Storage::disk('public')->download($certificate->file_path);
    }

    public function flightLogs()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        if (!class_exists('App\Models\FlightLog')) {
            return redirect()->route('dashboard')->with('error', 'Flight logs feature not available');
        }
        
        $flightLogs = FlightLog::where('user_id', Auth::id())
            ->orderBy('flight_date', 'desc')
            ->paginate(10);
            
        return view('dashboard.flight-logs', compact('flightLogs'));
    }

    public function createFlightLog()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        return view('dashboard.flight-logs-create');
    }

    public function storeFlightLog(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        if (!class_exists('App\Models\FlightLog')) {
            return redirect()->route('dashboard')->with('error', 'Flight logs feature not available');
        }
        
        $request->validate([
            'flight_date' => 'required|date',
            'duration' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'weather' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);

        FlightLog::create([
            'user_id' => Auth::id(),
            'flight_date' => $request->flight_date,
            'duration' => $request->duration,
            'location' => $request->location,
            'weather' => $request->weather,
            'notes' => $request->notes
        ]);

        return redirect()->route('dashboard.flight-logs')->with('success', 'Flight log added successfully!');
    }

    public function updateFlightLog(Request $request, $flightLogId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        if (!class_exists('App\Models\FlightLog')) {
            abort(404);
        }
        
        $flightLog = FlightLog::findOrFail($flightLogId);
        
        // Check if user owns this flight log
        if ($flightLog->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'flight_date' => 'required|date',
            'duration' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'weather' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);

        $flightLog->update($request->all());

        return redirect()->route('dashboard.flight-logs')->with('success', 'Flight log updated successfully!');
    }

    public function achievements()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // This would typically fetch user achievements from database
        $achievements = [];
        
        return view('dashboard.achievements', compact('achievements'));
    }
}
