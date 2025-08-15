@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Package Details Section -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
        <div class="relative h-64 bg-gradient-to-r 
            @if(str_contains($package->name, 'P1') || str_contains($package->name, 'P2'))
                from-purple-500 to-pink-400
            @elseif(str_contains($package->name, 'P3'))
                from-green-500 to-teal-400
            @elseif(str_contains($package->name, 'P4'))
                from-red-500 to-orange-400
            @elseif(str_contains($package->name, 'Tandem'))
                from-yellow-500 to-amber-400
            @else
                from-blue-500 to-green-400
            @endif">
            <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                <h1 class="text-4xl font-bold text-white text-center">{{ $package->name }}</h1>
            </div>
        </div>
        
        <div class="p-6">
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h2 class="text-2xl font-semibold mb-4">Package Details</h2>
                    <div class="space-y-3">
                        <p><span class="font-medium">Duration:</span>
                            @if(str_contains($package->name, 'P1')) 3-5 Days
                            @elseif(str_contains($package->name, 'P2')) Not Specified (Combined with P1)
                            @elseif(str_contains($package->name, 'P3')) 5-7 Days
                            @elseif(str_contains($package->name, 'P4')) 15-20 Days
                            @elseif(str_contains($package->name, 'Tandem') && $package->price == 2500) 15-20 Minutes
                            @elseif(str_contains($package->name, 'Tandem') && $package->price == 4000) 25-40 Minutes
                            @elseif(str_contains($package->name, 'Tandem') && $package->price == 6500) 45-60 Minutes
                            @else {{ $package->duration }} days @endif
                        </p>
                        <p><span class="font-medium">Price:</span> ₹{{ number_format($package->price) }} per person</p>
                        <p><span class="font-medium">Location:</span> {{ $package->location ?? 'Bir Billing, Himachal Pradesh' }}</p>
                    </div>
                    
                    <div class="mt-6">
                        <p class="text-gray-700">
                            @if(str_contains($package->name, 'P1'))
                                In this course, you will learn the following:<br>
                                - Wind & Site Assistance<br>
                                - Equipment Introduction: Understand the functions of the harness, wing, and other equipment like radio etc<br>
                                - Inflation/Forward Launch<br>
                                - Glider Control<br>
                                - Direction Control<br>
                                - Deflation<br>
                                - Mastering the art of paraglider control for a confident takeoff
                            @elseif(str_contains($package->name, 'P2'))
                                In this course, you will learn the following:<br>
                                - Thorough Pre-flight check for safe takeoffs<br>
                                - Develop habits for Safety from NOW. Nothing is worth compromising safety!<br>
                                - Direction control and drift<br>
                                - Body shift turns and Brake control turns<br>
                                - Safe gliding approach under Radio guidance all the time<br>
                                - Safe flying weather and wind condition<br>
                                - Basic air traffic rules
                            @elseif(str_contains($package->name, 'P3'))
                                This course is about completing and learning paragliding exercises:<br>
                                - Kiting Introduction (on ground)<br>
                                - Reverse Launch<br>
                                - Big Ears (safe height descending method)<br>
                                - Pitch, Yaw, and Roll Control (glider movement)<br>
                                - Normal and Tight 360 Turns<br>
                                - D RISER Turns<br>
                                - Hands Free/Toggle Free Flying<br>
                                - Introduction of Thermal and Ridge Soaring (height gaining techniques)
                            @elseif(str_contains($package->name, 'P4'))
                                In this course, you will learn the following:<br>
                                - Thermalling in detail<br>
                                - Advanced Kiting Skill (on the ground)<br>
                                - Wing Overs<br>
                                - Sharp 360's and Spiral Entry<br>
                                - Ridge Soaring<br>
                                - Flying on the Speed Bar (increase glide speed)<br>
                                - Long-distance fly under XC Instructor<br>
                                - Observation (15-20 km glide - 2 hrs flying time approximately)<br>
                                - Advance Meteorology (Weather knowledge suitable for flying)
                            @elseif(str_contains($package->name, 'Tandem'))
                                Enjoy a thrilling tandem paragliding experience with a certified instructor.<br>
                                - Fly with an expert pilot and enjoy breathtaking views of Bir Billing.
                            @else
                                {{ $package->description }}
                            @endif
                        </p>
                    </div>
                </div>
                
                <div>
                    @if(str_contains($package->name, 'P4'))
                        <div class="bg-yellow-100 p-4 rounded-lg border border-yellow-200">
                            <h3 class="font-semibold text-yellow-800 mb-2">Special Note</h3>
                            <p class="text-sm text-yellow-600">Advanced course requires prior experience. Ideal for experienced flyers!</p>
                        </div>
                    @elseif(str_contains($package->name, 'Tandem'))
                        <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                            <h3 class="font-semibold text-green-800 mb-2">What to Expect</h3>
                            <p class="text-sm text-gray-600">Fly with an expert pilot and enjoy stunning views.</p>
                        </div>
                    @else
                        <div class="grid md:grid-cols-2 gap-4 mb-6">
                            <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                                <h3 class="font-semibold text-green-800 mb-2 flex items-center">
                                    <span class="text-green-600 mr-2">✓</span>What's Included
                                </h3>
                                <p class="text-sm text-gray-600">Inclusions will be detailed during booking.</p>
                            </div>
                            
                            <div class="bg-red-50 p-4 rounded-lg border border-red-200">
                                <h3 class="font-semibold text-red-800 mb-2 flex items-center">
                                    <span class="text-red-600 mr-2">✗</span>What's Not Included
                                </h3>
                                <p class="text-sm text-gray-600">Exclusions will be detailed during booking.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Form Section -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-semibold mb-6">Book This Package</h2>
        
        <form id="bookingForm" method="POST" action="{{ route('bookings.store') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="package_id" value="{{ $package->id }}">
            
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Travel Date</label>
                    <input type="date" name="travel_date" required 
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                </div>
                
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Adults</label>
                        <select name="adults" required onchange="calculateTotal()" 
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @for($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ $i == 1 ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Children</label>
                        <select name="children" onchange="calculateTotal()" 
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @for($i = 0; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ $i == 0 ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="name" required value="{{ Auth::user()->name ?? '' }}"
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" required value="{{ Auth::user()->email ?? '' }}"
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                <input type="tel" name="phone" required 
                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Special Requests</label>
                <textarea name="special_requests" rows="3" 
                          class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                          placeholder="Any special requirements or requests..."></textarea>
            </div>
            
            <div class="border-t pt-4">
                <div class="flex justify-between items-center text-lg font-semibold">
                    <span>Total Amount:</span>
                    <span class="text-green-600" id="totalAmount">₹{{ number_format($package->price * (str_contains($package->name, 'Tandem') ? 1 : 2)) }}</span>
                </div>
            </div>
            
            <button type="submit" id="bookingBtn" 
                    class="w-full bg-blue-600 text-white py-4 rounded-lg font-semibold hover:bg-blue-700 transition duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                <span id="btnText">Book & Pay - ₹{{ number_format($package->price * (str_contains($package->name, 'Tandem') ? 1 : 2)) }}</span>
                <span id="btnLoader" class="hidden">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Processing...
                </span>
            </button>
        </form>
        
        <!-- Success/Error Messages -->
        <div id="alertContainer" class="mt-4 hidden">
            <div id="alertMessage" class="p-4 rounded-lg"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
// Global variables
const packagePrice = {{ $package->price }};
let isProcessing = false;

function calculateTotal() {
    const adults = parseInt(document.querySelector('[name="adults"]').value) || 0;
    const children = parseInt(document.querySelector('[name="children"]').value) || 0;
    const multiplier = {{ str_contains($package->name, 'Tandem') ? 1 : 2 }};
    const total = (adults + children) * packagePrice * multiplier;
    
    document.getElementById('totalAmount').textContent = '₹' + total.toLocaleString();
    document.getElementById('btnText').textContent = 'Book & Pay - ₹' + total.toLocaleString();
}

function showAlert(message, type = 'error') {
    const alertContainer = document.getElementById('alertContainer');
    const alertMessage = document.getElementById('alertMessage');
    
    alertContainer.classList.remove('hidden');
    
    let classes;
    switch(type) {
        case 'success':
            classes = 'bg-green-100 text-green-800 border border-green-200';
            break;
        case 'warning':
            classes = 'bg-yellow-100 text-yellow-800 border border-yellow-200';
            break;
        default:
            classes = 'bg-red-100 text-red-800 border border-red-200';
    }
    
    alertMessage.className = `p-4 rounded-lg ${classes}`;
    alertMessage.textContent = message;
    
    // Auto hide after 5 seconds
    setTimeout(() => {
        alertContainer.classList.add('hidden');
    }, 5000);
}

function setLoadingState(loading = true) {
    const bookingBtn = document.getElementById('bookingBtn');
    const btnText = document.getElementById('btnText');
    const btnLoader = document.getElementById('btnLoader');
    
    if (loading) {
        bookingBtn.disabled = true;
        btnText.classList.add('hidden');
        btnLoader.classList.remove('hidden');
        isProcessing = true;
    } else {
        bookingBtn.disabled = false;
        btnText.classList.remove('hidden');
        btnLoader.classList.add('hidden');
        isProcessing = false;
    }
}

function handlePaymentSuccess(response, bookingId) {
    console.log('Payment successful:', response);
    
    // Create hidden form to submit payment details
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("payments.callback") }}';
    form.style.display = 'none';
    
    const fields = {
        '_token': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        'razorpay_payment_id': response.razorpay_payment_id,
        'razorpay_order_id': response.razorpay_order_id,
        'razorpay_signature': response.razorpay_signature,
        'booking_id': bookingId
    };
    
    Object.keys(fields).forEach(key => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = key;
        input.value = fields[key];
        form.appendChild(input);
    });
    
    document.body.appendChild(form);
    form.submit();
}

// Enhanced form submission
document.addEventListener('DOMContentLoaded', function() {
    const bookingForm = document.getElementById('bookingForm');
    
    if (bookingForm) {
        bookingForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Prevent double submission
            if (isProcessing) {
                return;
            }
            
            console.log('=== BOOKING PROCESS STARTED ===');
            setLoadingState(true);
            
            try {
                // Validate Razorpay availability
                if (typeof Razorpay === 'undefined') {
                    throw new Error('Payment system not loaded. Please refresh the page and try again.');
                }
                
                const formData = new FormData(this);
                console.log('Submitting booking data...');
                
                // Submit booking to server
                const response = await fetch('{{ route("bookings.store") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                });
                
                if (!response.ok) {
                    const errorData = await response.json().catch(() => ({}));
                    throw new Error(errorData.message || `Server error: ${response.status}`);
                }
                
                const result = await response.json();
                console.log('Booking response:', result);
                
                if (!result.success) {
                    throw new Error(result.message || 'Booking creation failed');
                }
                
                if (!result.payment_data) {
                    throw new Error('Payment information not received');
                }
                
                const paymentData = result.payment_data;
                
                // Validate required payment fields
                if (!paymentData.key || !paymentData.order_id) {
                    throw new Error('Invalid payment configuration');
                }
                
                console.log('Initializing Razorpay payment...');
                
                // Initialize Razorpay
                const options = {
                    key: paymentData.key,
                    amount: paymentData.amount,
                    currency: paymentData.currency || 'INR',
                    order_id: paymentData.order_id,
                    name: 'MyBirBilling',
                    description: `Booking for ${document.querySelector('[name="name"]').value}`,
                    handler: function(response) {
                        handlePaymentSuccess(response, result.booking_id);
                    },
                    prefill: {
                        name: formData.get('name'),
                        email: formData.get('email'),
                        contact: formData.get('phone')
                    },
                    theme: {
                        color: '#3B82F6'
                    },
                    modal: {
                        ondismiss: function() {
                            console.log('Payment cancelled by user');
                            showAlert('Payment was cancelled. You can try again.', 'warning');
                            setLoadingState(false);
                        }
                    }
                };
                
                const rzp = new Razorpay(options);
                
                // Handle payment failures
                rzp.on('payment.failed', function(response) {
                    console.error('Payment failed:', response.error);
                    showAlert(`Payment failed: ${response.error.description}`, 'error');
                    setLoadingState(false);
                });
                
                // Open Razorpay modal
                rzp.open();
                
            } catch (error) {
                console.error('Booking error:', error);
                showAlert(error.message, 'error');
                setLoadingState(false);
            }
        });
    }
    
    // Initialize total calculation
    calculateTotal();
});

// Handle page visibility to prevent stuck loading states
document.addEventListener('visibilitychange', function() {
    if (!document.hidden && isProcessing) {
        // Reset if page becomes visible and we're still in processing state
        setTimeout(() => {
            setLoadingState(false);
        }, 1000);
    }
});
</script>
@endpush
