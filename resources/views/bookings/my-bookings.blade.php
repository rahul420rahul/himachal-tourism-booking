@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">My Bookings</h1>
    
    <div id="bookings-list">
        <div class="text-center py-8">
            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900"></div>
            <p class="mt-2 text-gray-600">Loading your bookings...</p>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-start mb-4">
            <h2 class="text-2xl font-bold">Booking Details</h2>
            <button onclick="closeDetailModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div id="modalContent"></div>
    </div>
</div>

<script>
let bookingsData = [];

function showBookingDetails(index) {
    const booking = bookingsData[index];
    const modal = document.getElementById('detailModal');
    const content = document.getElementById('modalContent');
    
    // Calculate payment amounts properly
    const totalAmount = booking.total_amount || booking.final_amount || 0;
    const advancePaid = booking.advance_amount || 0;
    const balanceDue = booking.pending_amount || 0;
    
    content.innerHTML = `
        <div class="space-y-6">
            <!-- Booking Information -->
            <div>
                <h3 class="font-semibold text-lg mb-3">Booking Information</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-600">Booking Number</p>
                        <p class="font-semibold">${booking.booking_number}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Status</p>
                        <p class="font-semibold">${booking.status}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Booking Date</p>
                        <p class="font-semibold">${new Date(booking.booking_date).toLocaleDateString('en-IN')} at ${booking.time_slot}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Payment ID</p>
                        <p class="font-semibold">${booking.razorpay_payment_id || 'N/A'}</p>
                    </div>
                </div>
            </div>
            
            <!-- Package Details -->
            <div>
                <h3 class="font-semibold text-lg mb-3">Package Details</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-600">Package Name</p>
                        <p class="font-semibold">${booking.package?.name || 'N/A'}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Activity Date</p>
                        <p class="font-semibold">${new Date(booking.booking_date).toLocaleDateString('en-IN')}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Time Slot</p>
                        <p class="font-semibold">${booking.time_slot}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Participants</p>
                        <p class="font-semibold">${booking.participants || booking.number_of_people || 1} Person(s)</p>
                    </div>
                </div>
            </div>
            
            <!-- Guest Information -->
            <div>
                <h3 class="font-semibold text-lg mb-3">Guest Information</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-600">Name</p>
                        <p class="font-semibold">${booking.guest_name}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Email</p>
                        <p class="font-semibold">${booking.guest_email}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Phone</p>
                        <p class="font-semibold">${booking.guest_phone}</p>
                    </div>
                </div>
            </div>
            
            <!-- Payment Summary - UPDATED -->
            <div class="border-t pt-4">
                <h3 class="font-semibold text-lg mb-3">Payment Summary</h3>
                <div class="space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Package Price</span>
                        <span class="font-semibold">₹${(booking.package_price || totalAmount).toFixed(2)} x ${booking.participants || 1}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Total Amount</span>
                        <span class="font-bold text-lg">₹${totalAmount.toFixed(2)}</span>
                    </div>
                    
                    ${booking.payment_status === 'partial' ? `
                        <div class="border-t pt-2 mt-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-green-600 font-medium">Advance Paid</span>
                                <span class="font-bold text-green-600">₹${advancePaid.toFixed(2)}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-orange-600 font-medium">Balance Due</span>
                                <span class="font-bold text-orange-600">₹${balanceDue.toFixed(2)}</span>
                            </div>
                        </div>
                    ` : `
                        <div class="border-t pt-2 mt-2">
                            <div class="flex justify-between">
                                <span class="text-green-600 font-medium">Payment Status</span>
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-bold">Fully Paid</span>
                            </div>
                        </div>
                    `}
                </div>
            </div>
            
            ${booking.special_requests ? `
            <div class="border-t pt-4">
                <h3 class="font-semibold text-lg mb-3">Special Requests</h3>
                <p class="text-gray-700">${booking.special_requests}</p>
            </div>
            ` : ''}
        </div>
    `;
    
    modal.classList.remove('hidden');
}

function closeDetailModal() {
    document.getElementById('detailModal').classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', function() {
    fetch('/api/my-bookings')
        .then(res => res.json())
        .then(bookings => {
            bookingsData = bookings;
            const container = document.getElementById('bookings-list');
            
            if(bookings.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-8">
                        <p class="text-gray-600 mb-4">No bookings found</p>
                        <a href="/packages" class="inline-block bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                            Browse Packages
                        </a>
                    </div>
                `;
                return;
            }
            
            let html = '<div class="grid gap-4">';
            bookings.forEach((booking, index) => {
                const totalAmount = booking.total_amount || booking.final_amount || 0;
                const advancePaid = booking.advance_amount || 0;
                const balanceDue = booking.pending_amount || 0;
                const isPaid = booking.payment_status === 'paid';
                const isPartial = booking.payment_status === 'partial';
                
                html += `
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="text-xl font-bold mb-2">${booking.package?.name || 'Package'}</h3>
                                <p class="text-gray-600 text-sm mb-1">Booking ID: ${booking.booking_number}</p>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                                    <div>
                                        <p class="text-gray-500 text-xs">Date</p>
                                        <p class="font-semibold">${new Date(booking.booking_date).toLocaleDateString('en-IN')}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-xs">Time</p>
                                        <p class="font-semibold">${booking.time_slot}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-xs">Total Amount</p>
                                        <p class="font-bold text-lg">₹${totalAmount}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-xs">Payment Status</p>
                                        ${isPartial ? 
                                            `<div>
                                                <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded text-xs font-medium">Advance Paid</span>
                                                <p class="text-xs mt-1">
                                                    <span class="text-green-600">Paid: ₹${advancePaid}</span><br>
                                                    <span class="text-orange-600">Due: ₹${balanceDue}</span>
                                                </p>
                                            </div>` : 
                                            `<span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-medium">Fully Paid</span>`
                                        }
                                    </div>
                                </div>
                            </div>
                            <div class="ml-4">
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium uppercase">
                                    ${booking.status}
                                </span>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t flex justify-end">
                            <button onclick="showBookingDetails(${index})" 
                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                View Full Details
                            </button>
                        </div>
                    </div>
                `;
            });
            html += '</div>';
            container.innerHTML = html;
        })
        .catch(error => {
            console.error('Error fetching bookings:', error);
            document.getElementById('bookings-list').innerHTML = `
                <div class="text-center py-8 text-red-600">
                    <p>Error loading bookings. Please refresh the page.</p>
                </div>
            `;
        });
});
</script>
@endsection
