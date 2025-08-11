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
                        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @foreach($bookings as $booking)
                                <div class="bg-gray-50 rounded-lg border p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-medium text-gray-900">
                                            {{ $booking->package->title ?? 'Package' }}
                                        </h3>
                                        <span class="px-3 py-1 text-xs rounded-full 
                                            @if($booking->status == 'confirmed') bg-green-100 text-green-800
                                            @elseif($booking->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($booking->status == 'cancelled') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($booking->status ?? 'Pending') }}
                                        </span>
                                    </div>

                                    <div class="space-y-3 text-sm text-gray-600">
                                        <div class="flex justify-between">
                                            <span>Booking Date:</span>
                                            <span class="font-medium">
                                                {{ $booking->booking_date ? $booking->booking_date->format('M d, Y') : 'Not set' }}
                                            </span>
                                        </div>
                                        
                                        <div class="flex justify-between">
                                            <span>Travelers:</span>
                                            <span class="font-medium">{{ $booking->travelers_count ?? 1 }}</span>
                                        </div>
                                        
                                        <div class="flex justify-between">
                                            <span>Amount:</span>
                                            <span class="font-medium text-green-600">
                                                ₹{{ number_format($booking->total_amount ?? 0, 2) }}
                                            </span>
                                        </div>
                                    </div>

                                    @if($booking->special_requirements)
                                        <div class="mt-4 p-3 bg-blue-50 rounded text-sm">
                                            <span class="font-medium text-blue-900">Special Requirements:</span>
                                            <p class="text-blue-800 mt-1">{{ $booking->special_requirements }}</p>
                                        </div>
                                    @endif

                                    <div class="mt-4 flex space-x-3">
                                        <a href="{{ route('bookings.show', $booking->id) }}" 
                                           class="flex-1 bg-blue-600 text-white text-center py-2 px-4 rounded-md text-sm hover:bg-blue-700">
                                            View Details
                                        </a>
                                        
                                        @if($booking->status == 'pending')
                                            <button class="flex-1 bg-red-600 text-white py-2 px-4 rounded-md text-sm hover:bg-red-700">
                                                Cancel
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No bookings yet</h3>
                            <p class="text-gray-600 mb-4">You haven't made any bookings yet. Start exploring our packages!</p>
                            <a href="{{ route('packages.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Browse Packages
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</body>
</html>
