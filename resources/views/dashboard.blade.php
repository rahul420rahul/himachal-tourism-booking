@extends('layouts.app')
@section('title', 'Dashboard - MyBirBilling')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100" x-data="dashboardData()" x-init="init()">
    <div class="container mx-auto px-4 py-8">
        <!-- Welcome Header -->
        <div class="mb-8 transform transition-all duration-1000" :class="visible ? 'translate-y-0 opacity-100' : '-translate-y-10 opacity-0'">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Welcome back, {{ auth()->user()->name }}!</h1>
            <p class="text-gray-600">Manage your bookings and track your adventure payments</p>
        </div>

        @php
            $user = auth()->user();
            $bookings = $user->bookings()->orderBy('created_at', 'desc')->take(5)->get();
            $pendingPayments = $user->bookings()->where('payment_status', 'partial')->count();
            $upcomingBookings = $user->bookings()->where('booking_date', '>=', now())->where('status', 'confirmed')->count();
            $totalSpent = $user->bookings()->where('payment_status', 'paid')->sum('final_amount');
        @endphp

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Total Bookings -->
            <div class="bg-white rounded-xl shadow-lg p-6 transform transition-all duration-500 hover:scale-105" 
                 :class="visible ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'" 
                 style="transition-delay: 100ms">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Total Bookings</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $bookings->count() }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-lg">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Upcoming Adventures -->
            <div class="bg-white rounded-xl shadow-lg p-6 transform transition-all duration-500 hover:scale-105" 
                 :class="visible ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'" 
                 style="transition-delay: 200ms">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Upcoming Adventures</p>
                        <p class="text-3xl font-bold text-green-600">{{ $upcomingBookings }}</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-lg">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending Payments -->
            <div class="bg-white rounded-xl shadow-lg p-6 transform transition-all duration-500 hover:scale-105" 
                 :class="visible ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'" 
                 style="transition-delay: 300ms">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Pending Payments</p>
                        <p class="text-3xl font-bold {{ $pendingPayments > 0 ? 'text-amber-600' : 'text-gray-900' }}">{{ $pendingPayments }}</p>
                    </div>
                    <div class="bg-amber-100 p-3 rounded-lg">
                        <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Spent -->
            <div class="bg-white rounded-xl shadow-lg p-6 transform transition-all duration-500 hover:scale-105" 
                 :class="visible ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'" 
                 style="transition-delay: 400ms">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Total Spent</p>
                        <p class="text-3xl font-bold text-gray-900">₹{{ number_format($totalSpent) }}</p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-lg">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Bookings Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 transform transition-all duration-700" 
             :class="visible ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'" 
             style="transition-delay: 500ms">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Recent Bookings</h2>
                <a href="{{ route('bookings.my') }}" class="text-blue-600 hover:text-blue-700 font-semibold flex items-center">
                    View All
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            @if($bookings->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Booking #</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Package</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($bookings as $booking)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm font-medium text-gray-900">{{ $booking->booking_number }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900">{{ $booking->package->name ?? 'N/A' }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900">{{ $booking->booking_date->format('d M Y') }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm font-semibold text-gray-900">₹{{ number_format($booking->final_amount) }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($booking->payment_status === 'paid')
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                ✓ Fully Paid
                                            </span>
                                        @elseif($booking->payment_status === 'partial')
                                            <div class="flex flex-col">
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800">
                                                    Partial Payment
                                                </span>
                                                <span class="text-xs text-gray-500 mt-1">
                                                    Paid: ₹{{ number_format($booking->advance_amount) }} | Due: ₹{{ number_format($booking->pending_amount) }}
                                                </span>
                                            </div>
                                        @else
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Payment Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('bookings.show', $booking->id) }}" 
                                               class="text-blue-600 hover:text-blue-900 font-medium">
                                                View
                                            </a>
                                            
                                            @if($booking->payment_status === 'partial' && $booking->pending_amount > 0)
                                                <button onclick="initiatePayment({{ $booking->id }}, {{ $booking->pending_amount }})" 
                                                        class="text-green-600 hover:text-green-900 font-medium">
                                                    Pay Balance
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No bookings yet</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by booking your first adventure!</p>
                    <div class="mt-6">
                        <a href="{{ route('packages.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            Browse Packages
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('packages.index') }}" 
               class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 text-white transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold mb-2">Browse Packages</h3>
                        <p class="text-blue-100">Explore new adventures</p>
                    </div>
                    <svg class="w-10 h-10 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </a>

            <a href="{{ route('bookings.my') }}" 
               class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-6 text-white transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold mb-2">My Bookings</h3>
                        <p class="text-purple-100">View all bookings</p>
                    </div>
                    <svg class="w-10 h-10 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </a>

            <a href="{{ route('profile.edit') }}" 
               class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-6 text-white transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold mb-2">My Profile</h3>
                        <p class="text-green-100">Manage account</p>
                    </div>
                    <svg class="w-10 h-10 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Payment Modal -->
<div id="paymentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Complete Payment</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Complete your remaining payment to confirm your booking.
                </p>
                <div class="mt-4 bg-gray-100 p-4 rounded">
                    <p class="text-lg font-bold">Amount Due: ₹<span id="paymentAmount"></span></p>
                </div>
            </div>
            <div class="items-center px-4 py-3">
                <button id="proceedPayment" class="px-4 py-2 bg-green-600 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Proceed to Pay
                </button>
                <button onclick="closePaymentModal()" class="mt-3 px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
function dashboardData() {
    return {
        visible: false,
        init() {
            setTimeout(() => {
                this.visible = true;
            }, 100);
        }
    }
}

let currentBookingId = null;

function initiatePayment(bookingId, amount) {
    currentBookingId = bookingId;
    document.getElementById('paymentAmount').textContent = amount.toFixed(2);
    document.getElementById('paymentModal').classList.remove('hidden');
}

function closePaymentModal() {
    document.getElementById('paymentModal').classList.add('hidden');
    currentBookingId = null;
}

document.getElementById('proceedPayment').addEventListener('click', function() {
    if (!currentBookingId) return;
    
    // Call backend to create Razorpay order
    fetch(`/bookings/${currentBookingId}/complete-payment`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.razorpay_order_id) {
            // Open Razorpay checkout
            var options = {
                key: data.razorpay_key,
                amount: data.amount,
                currency: "INR",
                name: "MyBirBilling",
                description: "Complete Payment for Booking #" + data.booking_number,
                order_id: data.razorpay_order_id,
                handler: function (response) {
                    // Payment successful, update backend
                    fetch(`/bookings/${currentBookingId}/verify-payment`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            razorpay_payment_id: response.razorpay_payment_id,
                            razorpay_order_id: response.razorpay_order_id,
                            razorpay_signature: response.razorpay_signature
                        })
                    })
                    .then(res => res.json())
                    .then(result => {
                        if (result.success) {
                            alert('Payment successful! Your booking is now fully paid.');
                            window.location.reload();
                        } else {
                            alert('Payment verification failed. Please contact support.');
                        }
                    });
                },
                prefill: {
                    name: "{{ auth()->user()->name }}",
                    email: "{{ auth()->user()->email }}",
                    contact: "{{ auth()->user()->phone ?? '' }}"
                },
                theme: {
                    color: "#3B82F6"
                }
            };
            
            var rzp = new Razorpay(options);
            rzp.open();
            closePaymentModal();
        } else {
            alert('Error creating payment order. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
});
</script>
@endsection