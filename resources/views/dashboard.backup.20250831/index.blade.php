@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Flights</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_flights'] ?? 1 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-plane fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Flight Hours</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['total_hours'] ?? 0, 1) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Certificates</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['certificates'] ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-certificate fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Achievements</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['achievements'] ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-trophy fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-center flex-wrap gap-3">
                <a href="{{ route('dashboard.certificates') }}" class="text-decoration-none">
                    <div class="text-center p-4">
                        <div class="bg-warning rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="fas fa-trophy fa-2x text-white"></i>
                        </div>
                        <p class="mt-2 mb-0 font-weight-bold">Certificates</p>
                    </div>
                </a>

                <a href="{{ route('dashboard.gallery') }}" class="text-decoration-none">
                    <div class="text-center p-4">
                        <div class="bg-info rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="fas fa-camera fa-2x text-white"></i>
                        </div>
                        <p class="mt-2 mb-0 font-weight-bold">Gallery</p>
                    </div>
                </a>

                <a href="{{ route('dashboard.achievements') }}" class="text-decoration-none">
                    <div class="text-center p-4">
                        <div class="bg-danger rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="fas fa-award fa-2x text-white"></i>
                        </div>
                        <p class="mt-2 mb-0 font-weight-bold">Achievements</p>
                    </div>
                </a>

                <a href="{{ route('dashboard.statistics') }}" class="text-decoration-none">
                    <div class="text-center p-4">
                        <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="fas fa-chart-bar fa-2x text-white"></i>
                        </div>
                        <p class="mt-2 mb-0 font-weight-bold">Statistics</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Flights Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Flights</h6>
                    <a href="{{ route('dashboard.flight-logs') }}" class="btn btn-sm btn-primary">View All →</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>DATE</th>
                                    <th>SITE</th>
                                    <th>DURATION</th>
                                    <th>MAX ALTITUDE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($recentFlights && count($recentFlights) > 0)
                                    @foreach($recentFlights as $flight)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($flight->flight_date)->format('M d, Y') }}</td>
                                        <td>{{ $flight->site ?? 'N/A' }}</td>
                                        <td>{{ number_format($flight->duration ?? 0, 1) }} hrs</td>
                                        <td>{{ $flight->max_altitude ?? 55 }} m</td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>Aug 25, 2025</td>
                                        <td></td>
                                        <td>0.0 hrs</td>
                                        <td>55 m</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Flight Log Button -->
    <div class="position-fixed" style="bottom: 30px; right: 30px;">
        <a href="{{ route('dashboard.flight-logs.create') }}" class="btn btn-success btn-lg rounded-pill shadow-lg">
            + Add Flight Log
        </a>
    </div>
</div>

<style>
.border-left-primary {
    border-left: 4px solid #4e73df !important;
}
.border-left-success {
    border-left: 4px solid #1cc88a !important;
}
.border-left-info {
    border-left: 4px solid #36b9cc !important;
}
.border-left-warning {
    border-left: 4px solid #f6c23e !important;
}
</style>
@endsection
