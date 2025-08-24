<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings - MyBirBilling</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">
                            MyBirBilling
                        </a>
                    </div>
                    <nav class="flex space-x-8">
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">Home</a>
                        <a href="{{ route('packages.index') }}" class="text-gray-700 hover:text-blue-600">Packages</a>
                        @auth
                            <a href="{{ route('bookings.my') }}" class="text-blue-600 font-medium">My Bookings</a>
                            <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-700 hover:text-blue-600">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Register</a>
                        @endauth
                    </nav>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h1 class="text-2xl font-semibold text-gray-900">My Bookings</h1>
                    <p class="mt-1 text-sm text-gray-600">View and manage your travel bookings</p>
                </div>

                <div class="p-6">
                    @if($bookings->count() > 0)
                        <div class="space-y-6">
                            @foreach($bookings as $booking)
                                <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                                    <div class="p-6">
                                        <!-- Header with Package Name and Status -->
                                        <div class="flex items-center justify-between mb-6">
                                            <div>
                                                <h3 class="text-xl font-semibold text-gray-900">
                                                    {{ $booking->package->name ?? 'Package Name' }}
                                                </h3>
                                                <p class="text-sm text-gray-500 mt-1">
                                                    Booking ID: {{ $booking->booking_number }}
                                                </p>
                                            </div>
                                            <div>
                                                @php
                                                    $statusClass = 'bg-gray-100 text-gray-800';
                                                    $statusText = 'Unknown';
                                                    
                                                    if ($booking->payment_status === 'advance_paid') {
                                                        $statusClass = 'bg-green-100 text-green-800';
                                                        $statusText = 'Confirmed';
                                                    } elseif ($booking->payment_status === 'pending') {
                                                        $statusClass = 'bg-yellow-100 text-yellow-800';
                                                        $statusText = 'Pending';
                                                    } elseif ($booking->payment_status === 'failed') {
                                                        $statusClass = 'bg-red-100 text-red-800';
                                                        $statusText = 'Failed';
                                                    } elseif ($booking->payment_status === 'partial') {
                                                        $statusClass = 'bg-blue-100 text-blue-800';
                                                        $statusText = 'Partial';
                                                    }
                                                @endphp
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusClass }}">
                                                    {{ $statusText }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Main Details Grid -->
                                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Date</label>
                                                <p class="text-sm font-medium text-gray-900">
                                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}
                                                </p>
                                            </div>
                                            
                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Time</label>
                                                <p class="text-sm font-medium text-gray-900">
                                                    {{ $booking->time_slot ?? '10:00' }}
                                                </p>
                                            </div>

                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Participants</label>
                                                <p class="text-sm font-medium text-gray-900">
                                                    {{ $booking->participants }} Person{{ $booking->participants > 1 ? 's' : '' }}
                                                </p>
                                            </div>

                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Location</label>
                                                <p class="text-sm font-medium text-gray-900">
                                                    Bir Billing, HP
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Guest Information -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Guest Name</label>
                                                <p class="text-sm font-medium text-gray-900">{{ $booking->guest_name }}</p>
                                            </div>
                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Email</label>
                                                <p class="text-sm font-medium text-gray-900">{{ $booking->guest_email }}</p>
                                            </div>
                                        </div>

                                        <!-- Payment Summary -->
                                        <div class="bg-gray-50 rounded-lg p-4 mb-6">
                                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                                <div>
                                                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Package Price</label>
                                                    <p class="text-sm font-medium text-gray-900">
                                                        ₹{{ number_format(($booking->final_amount ?? 0) / ($booking->participants ?? 1)) }} x {{ $booking->participants }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Total Amount</label>
                                                    <p class="text-lg font-bold text-gray-900">₹{{ number_format($booking->final_amount ?? 0) }}</p>
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Advance Paid</label>
                                                    <p class="text-sm font-medium text-green-600">
                                                        ₹{{ number_format($booking->advance_amount ?? 0) }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Balance Due</label>
                                                    <p class="text-sm font-medium text-orange-600">
                                                        ₹{{ number_format(($booking->final_amount ?? 0) - ($booking->advance_amount ?? 0)) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Special Requests -->
                                        @if($booking->special_requests)
                                        <div class="mb-6">
                                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Special Requests</label>
                                            <p class="text-sm text-gray-900 bg-blue-50 p-3 rounded">{{ $booking->special_requests }}</p>
                                        </div>
                                        @endif

                                        <!-- Footer with timestamp and actions -->
                                        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                            <div class="text-xs text-gray-500">
                                                Booked on {{ \Carbon\Carbon::parse($booking->created_at)->format('M d, Y \a\t h:i A') }}
                                            </div>
                                            <div class="flex space-x-3">
                                                <a href="{{ route('bookings.show', $booking->id) }}" 
                                                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                    View Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if($bookings->hasPages())
                        <div class="mt-8">
                            {{ $bookings->links() }}
                        </div>
                        @endif

                    @else
                        <!-- Empty State -->
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012-2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No bookings found</h3>
                            <p class="mt-1 text-sm text-gray-500">You haven't made any bookings yet.</p>
                            <div class="mt-6">
                                <a href="{{ route('packages.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Browse Packages
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</body>
</html>