@extends('layouts.app')

@section('content')
<style>
    .stats-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        text-align: center;
    }
    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 24px;
        color: white;
    }
    .stats-value {
        font-size: 2.5rem;
        font-weight: bold;
        margin: 10px 0;
    }
    .stats-label {
        color: #6c757d;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .action-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        color: inherit;
        display: block;
    }
    .action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }
    .action-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 15px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: white;
    }
</style>

<div class="container-fluid px-4 py-4">
    <!-- Header with Add Flight Log Button -->
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('dashboard.flight-logs.create') }}" class="btn btn-success btn-lg" style="background: #28a745; border: none; border-radius: 25px; padding: 12px 30px;">
            <i class="fas fa-plus"></i> Add Flight Log
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-5">
        <div class="col-md-3 mb-4">
            <div class="stats-card">
                <div class="stats-icon" style="background: #3b82f6;">
                    <i class="fas fa-plane"></i>
                </div>
                <div class="stats-label">Total Flights</div>
                <div class="stats-value">{{ $stats['total_flights'] ?? 1 }}</div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="stats-card">
                <div class="stats-icon" style="background: #10b981;">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stats-label">Flight Hours</div>
                <div class="stats-value">{{ number_format($stats['total_hours'] ?? 0, 1) }}</div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="stats-card">
                <div class="stats-icon" style="background: #8b5cf6;">
                    <i class="fas fa-certificate"></i>
                </div>
                <div class="stats-label">Certificates</div>
                <div class="stats-value">{{ $stats['certificates'] ?? 0 }}</div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="stats-card">
                <div class="stats-icon" style="background: #f59e0b;">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="stats-label">Achievements</div>
                <div class="stats-value">{{ $stats['achievements'] ?? 0 }}</div>
            </div>
        </div>
    </div>

    <!-- Action Cards -->
    <div class="row mb-5">
        <div class="col-md-3 mb-4">
            <a href="{{ route('dashboard.certificates') }}" class="action-card">
                <div class="action-icon" style="background: #fbbf24;">
                    <i class="fas fa-trophy"></i>
                </div>
                <h5 class="font-weight-bold">Certificates</h5>
            </a>
        </div>
        
        <div class="col-md-3 mb-4">
            <a href="{{ route('dashboard.gallery') }}" class="action-card">
                <div class="action-icon" style="background: #60a5fa;">
                    <i class="fas fa-camera"></i>
                </div>
                <h5 class="font-weight-bold">Gallery</h5>
            </a>
        </div>
        
        <div class="col-md-3 mb-4">
            <a href="{{ route('dashboard.achievements') }}" class="action-card">
                <div class="action-icon" style="background: #f87171;">
                    <i class="fas fa-award"></i>
                </div>
                <h5 class="font-weight-bold">Achievements</h5>
            </a>
        </div>
        
        <div class="col-md-3 mb-4">
            <a href="{{ route('dashboard.statistics') }}" class="action-card">
                <div class="action-icon" style="background: #60a5fa;">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <h5 class="font-weight-bold">Statistics</h5>
            </a>
        </div>
    </div>

    <!-- Recent Flights Table -->
    <div class="card shadow-sm" style="border: none; border-radius: 15px;">
        <div class="card-header bg-white" style="border-radius: 15px 15px 0 0; padding: 20px 25px;">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 font-weight-bold">Recent Flights</h5>
                <a href="{{ route('dashboard.flight-logs') }}" class="text-primary text-decoration-none">
                    View All →
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background: #f8f9fa;">
                        <tr>
                            <th class="border-0 px-4 py-3 text-uppercase small font-weight-bold text-muted">DATE</th>
                            <th class="border-0 px-4 py-3 text-uppercase small font-weight-bold text-muted">SITE</th>
                            <th class="border-0 px-4 py-3 text-uppercase small font-weight-bold text-muted">DURATION</th>
                            <th class="border-0 px-4 py-3 text-uppercase small font-weight-bold text-muted">MAX ALTITUDE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($recentFlights && count($recentFlights) > 0)
                            @foreach($recentFlights as $flight)
                            <tr>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($flight->flight_date)->format('M d, Y') }}</td>
                                <td class="px-4 py-3">{{ $flight->site ?? '' }}</td>
                                <td class="px-4 py-3">{{ number_format($flight->duration ?? 0, 1) }} hrs</td>
                                <td class="px-4 py-3">{{ $flight->max_altitude ?? 0 }} m</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="px-4 py-3">Aug 25, 2025</td>
                                <td class="px-4 py-3"></td>
                                <td class="px-4 py-3">0.0 hrs</td>
                                <td class="px-4 py-3">55 m</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
