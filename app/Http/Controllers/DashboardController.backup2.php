<?php

namespace App\Http\Controllers;

use App\Models\FlightLog;
use App\Models\Gallery;
use App\Models\Certificate;
use App\Models\Achievement;
use App\Models\UserStatistics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    // Main dashboard
    public function index()
    {
        $user = Auth::user();
        
        $stats = [
            'total_flights' => FlightLog::where('user_id', $user->id)->count(),
            'total_hours' => FlightLog::where('user_id', $user->id)->sum('duration'),
            'total_distance' => FlightLog::where('user_id', $user->id)->sum('distance'),
            'max_altitude' => FlightLog::where('user_id', $user->id)->max('max_altitude'),
            'certificates' => Certificate::where('user_id', $user->id)->count(),
            'achievements' => Achievement::whereHas('users', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })->count(),
        ];

        $recentFlights = FlightLog::where('user_id', $user->id)
            ->orderBy('flight_date', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recentFlights'));
    }

    // Gallery methods
    public function gallery()
    {
        $galleries = Gallery::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $flightLogs = FlightLog::where('user_id', Auth::id())
            ->orderBy('flight_date', 'desc')
            ->get();

        return view('dashboard.gallery', compact('galleries', 'flightLogs'));
    }

    public function uploadToGallery(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mpeg,quicktime|max:51200', // 50MB max
            'flight_log_id' => 'nullable|exists:flight_logs,id',
            'category' => 'required|in:flight,equipment,scenery,team,other',
            'is_public' => 'boolean'
        ]);

        $file = $request->file('file');
        $path = $file->store('gallery/' . Auth::id(), 'public');

        $gallery = Gallery::create([
            'user_id' => Auth::id(),
            'flight_log_id' => $request->flight_log_id,
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $path,
            'type' => $file->getMimeType(),
            'category' => $request->category,
            'is_public' => $request->boolean('is_public', false)
        ]);

        return redirect()->route('dashboard.gallery')
            ->with('success', 'File uploaded successfully!');
    }

    public function deleteGalleryItem($id)
    {
        $gallery = Gallery::where('user_id', Auth::id())->findOrFail($id);
        
        // Delete file from storage
        if (Storage::disk('public')->exists($gallery->file_path)) {
            Storage::disk('public')->delete($gallery->file_path);
        }
        
        $gallery->delete();

        return redirect()->route('dashboard.gallery')
            ->with('success', 'Gallery item deleted successfully!');
    }

    // Certificates methods
    public function certificates()
    {
        $certificates = Certificate::where('user_id', Auth::id())
            ->orderBy('issued_date', 'desc')
            ->get();

        // Check and generate automatic certificates
        $this->checkAndGenerateCertificates();

        return view('dashboard.certificates', compact('certificates'));
    }

    private function checkAndGenerateCertificates()
    {
        $user = Auth::user();
        $flightCount = FlightLog::where('user_id', $user->id)->count();
        $totalHours = FlightLog::where('user_id', $user->id)->sum('duration');

        // First Flight Certificate
        if ($flightCount >= 1 && !Certificate::where('user_id', $user->id)->where('type', 'first_flight')->exists()) {
            Certificate::create([
                'user_id' => $user->id,
                'type' => 'first_flight',
                'title' => 'First Flight Certificate',
                'description' => 'Congratulations on completing your first paragliding flight!',
                'certificate_number' => 'CERT-' . Str::upper(Str::random(10)),
                'issued_date' => now()
            ]);
        }

        // 10 Flights Milestone
        if ($flightCount >= 10 && !Certificate::where('user_id', $user->id)->where('type', '10_flights')->exists()) {
            Certificate::create([
                'user_id' => $user->id,
                'type' => '10_flights',
                'title' => '10 Flights Milestone',
                'description' => 'Achievement unlocked: 10 successful flights completed!',
                'certificate_number' => 'CERT-' . Str::upper(Str::random(10)),
                'issued_date' => now()
            ]);
        }

        // 50 Hours Milestone
        if ($totalHours >= 50 && !Certificate::where('user_id', $user->id)->where('type', '50_hours')->exists()) {
            Certificate::create([
                'user_id' => $user->id,
                'type' => '50_hours',
                'title' => '50 Hours Airtime',
                'description' => 'Congratulations on achieving 50 hours of flight time!',
                'certificate_number' => 'CERT-' . Str::upper(Str::random(10)),
                'issued_date' => now()
            ]);
        }
    }

    public function downloadCertificate($id)
    {
        $certificate = Certificate::where('user_id', Auth::id())->findOrFail($id);
        
        // Generate PDF logic here
        return view('certificates.download', compact('certificate'));
    }

    // Achievements methods
    public function achievements()
    {
        $user = Auth::user();
        
        // Check and unlock achievements
        $this->checkAndUnlockAchievements();
        
        $allAchievements = Achievement::all();
        $userAchievements = $user->achievements()->pluck('achievement_id')->toArray();

        return view('dashboard.achievements', compact('allAchievements', 'userAchievements'));
    }

    private function checkAndUnlockAchievements()
    {
        $user = Auth::user();
        $stats = [
            'flights' => FlightLog::where('user_id', $user->id)->count(),
            'hours' => FlightLog::where('user_id', $user->id)->sum('duration'),
            'max_altitude' => FlightLog::where('user_id', $user->id)->max('max_altitude'),
            'total_distance' => FlightLog::where('user_id', $user->id)->sum('distance')
        ];

        // Define achievements
        $achievementCriteria = [
            ['type' => 'first_flight', 'condition' => $stats['flights'] >= 1],
            ['type' => 'high_flyer', 'condition' => $stats['max_altitude'] >= 3000],
            ['type' => 'long_distance', 'condition' => $stats['total_distance'] >= 100],
            ['type' => 'veteran', 'condition' => $stats['hours'] >= 100],
        ];

        foreach ($achievementCriteria as $criteria) {
            if ($criteria['condition']) {
                $achievement = Achievement::firstOrCreate(['type' => $criteria['type']]);
                $user->achievements()->syncWithoutDetaching([$achievement->id => ['unlocked_at' => now()]]);
            }
        }
    }

    // Statistics methods
    public function statistics()
    {
        $user = Auth::user();
        
        $stats = [
            'total_flights' => FlightLog::where('user_id', $user->id)->count(),
            'total_hours' => FlightLog::where('user_id', $user->id)->sum('duration'),
            'total_distance' => FlightLog::where('user_id', $user->id)->sum('distance'),
            'max_altitude' => FlightLog::where('user_id', $user->id)->max('max_altitude'),
            'avg_duration' => FlightLog::where('user_id', $user->id)->avg('duration'),
            'favorite_site' => FlightLog::where('user_id', $user->id)
                ->select('site', \DB::raw('count(*) as count'))
                ->groupBy('site')
                ->orderByDesc('count')
                ->first(),
        ];

        $monthlyFlights = FlightLog::where('user_id', $user->id)
            ->selectRaw('MONTH(flight_date) as month, COUNT(*) as count')
            ->whereYear('flight_date', date('Y'))
            ->groupBy('month')
            ->get();

        return view('dashboard.statistics', compact('stats', 'monthlyFlights'));
    }

    // Flight Log methods (existing)
    public function flightLogs()
    {
        $flightLogs = FlightLog::where('user_id', Auth::id())
            ->orderBy('flight_date', 'desc')
            ->paginate(10);

        return view('dashboard.flight-logs', compact('flightLogs'));
    }

    public function createFlightLog()
    {
        return view('dashboard.flight-logs-create');
    }

    public function storeFlightLog(Request $request)
    {
        $validated = $request->validate([
            'flight_date' => 'required|date',
            'site' => 'required|string|max:255',
            'duration' => 'required|numeric|min:0',
            'max_altitude' => 'required|numeric|min:0',
            'distance' => 'nullable|numeric|min:0',
            'wing_model' => 'nullable|string|max:255',
            'weather_conditions' => 'nullable|string',
            'notes' => 'nullable|string'
        ]);

        $validated['user_id'] = Auth::id();
        
        FlightLog::create($validated);

        return redirect()->route('dashboard.flight-logs')
            ->with('success', 'Flight log added successfully!');
    }

    public function editFlightLog(FlightLog $flightLog)
    {
        if ($flightLog->user_id !== Auth::id()) {
            abort(403);
        }

        return view('dashboard.flight-logs-edit', compact('flightLog'));
    }

    public function updateFlightLog(Request $request, FlightLog $flightLog)
    {
        if ($flightLog->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'flight_date' => 'required|date',
            'site' => 'required|string|max:255',
            'duration' => 'required|numeric|min:0',
            'max_altitude' => 'required|numeric|min:0',
            'distance' => 'nullable|numeric|min:0',
            'wing_model' => 'nullable|string|max:255',
            'weather_conditions' => 'nullable|string',
            'notes' => 'nullable|string'
        ]);

        $flightLog->update($validated);

        return redirect()->route('dashboard.flight-logs')
            ->with('success', 'Flight log updated successfully!');
    }

    public function destroyFlightLog(FlightLog $flightLog)
    {
        if ($flightLog->user_id !== Auth::id()) {
            abort(403);
        }

        $flightLog->delete();

        return redirect()->route('dashboard.flight-logs')
            ->with('success', 'Flight log deleted successfully!');
    }
}
