@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <h1 class="h2 mb-4">Admin Dashboard</h1>
    
    <!-- Revenue Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Revenue</h5>
                    <h2 class="mb-0">₹{{ number_format($stats['total_revenue']) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Today's Revenue</h5>
                    <h2 class="mb-0">₹{{ number_format($stats['today_revenue']) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Total Bookings</h5>
                    <h2 class="mb-0">{{ $stats['total_bookings'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <h2 class="mb-0">{{ $stats['total_users'] }}</h2>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Bookings -->
    <div class="card">
        <div class="card-header">
            <h4>Recent Bookings</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Package</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentBookings as $booking)
                        <tr>
                            <td>#{{ $booking->id }}</td>
                            <td>{{ $booking->user->name ?? $booking->guest_name }}</td>
                            <td>{{ $booking->package->name }}</td>
                            <td>{{ $booking->created_at->format('d M Y') }}</td>
                            <td>₹{{ number_format($booking->total_amount) }}</td>
                            <td>
                                <span class="badge bg-{{ $booking->status == 'confirmed' ? 'success' : 'warning' }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('bookings.show', $booking) }}" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
