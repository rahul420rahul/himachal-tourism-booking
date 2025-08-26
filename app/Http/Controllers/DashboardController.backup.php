<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\FlightLog;
use App\Models\Achievement;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get statistics
        $stats = (object)[
            'total_flights' => FlightLog::where('user_id', $user->id)->count(),
            'total_flight_hours' => FlightLog::where('user_id', $user->id)->sum('flight_duration') / 60,
        ];
        
        // Get recent data
        $certificates = Certificate::where('user_id', $user->id)->latest()->get();
        $recentFlightLogs = FlightLog::where('user_id', $user->id)->latest()->take(5)->get();
        $recentAchievements = Achievement::where('user_id', $user->id)->latest()->take(5)->get();
        
        return view('dashboard', compact('stats', 'certificates', 'recentFlightLogs', 'recentAchievements'));
    }
    
    public function certificates()
    {
        $certificates = Certificate::where('user_id', Auth::id())->get();
        return view('dashboard.certificates', compact('certificates'));
    }
    
    public function downloadCertificate(Certificate $certificate)
    {
        // Implement certificate download logic
        return response()->download(storage_path('app/public/' . $certificate->file_path));
    }
    
    public function gallery()
    {
        return view('dashboard.gallery');
    }
    
    public function uploadToGallery(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'file' => 'required|file|mimes:jpg,jpeg,png,gif,mp4,avi,mov|max:51200' // 50MB max
        ]);
        
        $file = $request->file('file');
        $filePath = $file->store('gallery', 'public');
        
        // Determine if it's a photo or video
        $type = in_array($file->getClientOriginalExtension(), ['mp4', 'avi', 'mov']) ? 'video' : 'photo';
        
        Gallery::create([
            'user_id' => Auth::id(),
            'title' => $request->title ?? 'Untitled',
            'file_path' => $filePath,
            'type' => $type,
        ]);
        
        return redirect()->route('dashboard.gallery')->with('success', 'File uploaded successfully!');
    }
    
    public function flightLogs()
    {
        $flightLogs = FlightLog::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->paginate(10);
        
        return view('dashboard.flight-logs', compact('flightLogs'));
    }
    
    public function achievements()
    {
        $achievements = Achievement::where('user_id', Auth::id())->get();
        return view('dashboard.achievements', compact('achievements'));
    }
    
    public function statistics()
    {
        $stats = (object)[
            'total_flights' => FlightLog::where('user_id', Auth::id())->count(),
            'total_hours' => FlightLog::where('user_id', Auth::id())->sum('flight_duration') / 60,
            'max_altitude' => FlightLog::where('user_id', Auth::id())->max('max_altitude'),
            'total_distance' => FlightLog::where('user_id', Auth::id())->sum('distance'),
        ];
        
        return view('dashboard.statistics', compact('stats'));
    }
    
    // Flight Log CRUD Methods
    public function createFlightLog()
    {
        return view('dashboard.flight-logs-create');
    }
    
    public function storeFlightLog(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'site_name' => 'required|string|max:255',
            'launch_time' => 'required',
            'landing_time' => 'required',
            'max_altitude' => 'nullable|numeric',
            'distance' => 'nullable|numeric',
            'glider_model' => 'nullable|string|max:255',
            'weather_conditions' => 'nullable|string',
            'wind_speed' => 'nullable|string|max:50',
            'wind_direction' => 'nullable|string|max:10',
            'notes' => 'nullable|string',
            'track_file' => 'nullable|file|mimes:gpx,igc,kml|max:10240',
            'photos.*' => 'nullable|image|max:5120'
        ]);
        
        // Calculate flight duration
        $launchTime = Carbon::parse($request->date . ' ' . $request->launch_time);
        $landingTime = Carbon::parse($request->date . ' ' . $request->landing_time);
        $duration = $launchTime->diffInMinutes($landingTime);
        
        // Handle file uploads
        $trackFilePath = null;
        if ($request->hasFile('track_file')) {
            $trackFilePath = $request->file('track_file')->store('flight-tracks', 'public');
        }
        
        $photos = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photos[] = $photo->store('flight-photos', 'public');
            }
        }
        
        // Create flight log
        $flightLog = FlightLog::create([
            'user_id' => Auth::id(),
            'date' => $launchTime,
            'site_name' => $request->site_name,
            'launch_time' => $launchTime,
            'landing_time' => $landingTime,
            'flight_duration' => $duration,
            'max_altitude' => $request->max_altitude,
            'distance' => $request->distance,
            'glider_model' => $request->glider_model,
            'weather_conditions' => $request->weather_conditions,
            'wind_speed' => $request->wind_speed,
            'wind_direction' => $request->wind_direction,
            'notes' => $request->notes,
            'track_file' => $trackFilePath,
            'photos' => json_encode($photos),
            'is_verified' => false
        ]);
        
        return redirect()->route('dashboard.flight-logs')->with('success', 'Flight log added successfully!');
    }
    
    public function editFlightLog(FlightLog $flightLog)
    {
        // Check if user owns this flight log
        if ($flightLog->user_id !== Auth::id()) {
            abort(403);
        }
        
        return view('dashboard.flight-logs-edit', compact('flightLog'));
    }
    
    public function updateFlightLog(Request $request, FlightLog $flightLog)
    {
        // Check if user owns this flight log
        if ($flightLog->user_id !== Auth::id()) {
            abort(403);
        }
        
        $request->validate([
            'date' => 'required|date',
            'site_name' => 'required|string|max:255',
            'launch_time' => 'required',
            'landing_time' => 'required',
            'max_altitude' => 'nullable|numeric',
            'distance' => 'nullable|numeric',
        ]);
        
        // Calculate flight duration
        $launchTime = Carbon::parse($request->date . ' ' . $request->launch_time);
        $landingTime = Carbon::parse($request->date . ' ' . $request->landing_time);
        $duration = $launchTime->diffInMinutes($landingTime);
        
        $flightLog->update([
            'date' => $launchTime,
            'site_name' => $request->site_name,
            'launch_time' => $launchTime,
            'landing_time' => $landingTime,
            'flight_duration' => $duration,
            'max_altitude' => $request->max_altitude,
            'distance' => $request->distance,
            'glider_model' => $request->glider_model,
            'weather_conditions' => $request->weather_conditions,
            'wind_speed' => $request->wind_speed,
            'wind_direction' => $request->wind_direction,
            'notes' => $request->notes,
        ]);
        
        return redirect()->route('dashboard.flight-logs')->with('success', 'Flight log updated successfully!');
    }
    
    public function destroyFlightLog(FlightLog $flightLog)
    {
        // Check if user owns this flight log
        if ($flightLog->user_id !== Auth::id()) {
            abort(403);
        }
        
        // Delete associated files
        if ($flightLog->track_file) {
            Storage::disk('public')->delete($flightLog->track_file);
        }
        
        if ($flightLog->photos) {
            $photos = json_decode($flightLog->photos, true);
            if (is_array($photos)) {
                foreach ($photos as $photo) {
                    Storage::disk('public')->delete($photo);
                }
            }
        }
        
        $flightLog->delete();
        
        return redirect()->route('dashboard.flight-logs')->with('success', 'Flight log deleted successfully!');
    }
}
    public function deleteGalleryItem($id)
    {
        $gallery = Gallery::find($id);
        
        if ($gallery && $gallery->user_id == Auth::id()) {
            Storage::disk('public')->delete($gallery->file_path);
            $gallery->delete();
            return redirect()->route('dashboard.gallery')->with('success', 'Item deleted successfully!');
        }
        
        return redirect()->route('dashboard.gallery')->with('error', 'Item not found!');
    }

    public function deleteGalleryItem($id)
    {
        $gallery = Gallery::find($id);
        
        if ($gallery && $gallery->user_id == Auth::id()) {
            Storage::disk('public')->delete($gallery->file_path);
            $gallery->delete();
            return redirect()->route('dashboard.gallery')->with('success', 'Item deleted successfully!');
        }
        
        return redirect()->route('dashboard.gallery')->with('error', 'Item not found!');
    }

