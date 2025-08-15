@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Package Details Section -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
        <div class="relative h-64 bg-gradient-to-r from-blue-500 to-green-400">
            <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                <h1 class="text-4xl font-bold text-white text-center">{{ $package->name }}</h1>
            </div>
        </div>
        
        <div class="p-6">
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h2 class="text-2xl font-semibold mb-4">Package Details</h2>
                    <div class="space-y-3">
                        <p><span class="font-medium">Duration:</span> {{ $package->duration }} days</p>
                        <p><span class="font-medium">Price:</span> ₹{{ number_format($package->price) }} per person</p>
                        <p><span class="font-medium">Location:</span> {{ $package->location }}</p>
                    </div>
                    
                    <div class="mt-6">
                        <p class="text-gray-700">{{ $package->description }}</p>
                    </div>
                </div>
                
                <div>
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
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Form Section -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-semibold mb-6">Book This Package</h2>
        
        <form id="bookingForm" class="space-y-4">
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
                                <option value="{{ $i }}" {{ $i == 2 ? 'selected' : '' }}>{{ $i }}</option>
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
                    <span class="text-green-600" id="totalAmount">₹{{ number_format($package->price * 2) }}</span>
                </div>
            </div>
            
            <button type="submit" id="bookingBtn" 
                    class="w-full bg-blue-600 text-white py-4 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                <span id="btnText">Book & Pay - ₹{{ number_format($package->price * 2) }}</span>
                <span id="btnLoader" class="hidden">Processing...</span>
            </button>
        </form>
        
        <!-- Success/Error Messages -->
        <div id="alertContainer" class="mt-4 hidden">
            <div id="alertMessage" class="p-4 rounded-lg"></div>
        </div>
    </div>
</div>

<!-- Razorpay Script -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
const packagePrice = {{ $package->price }};

function calculateTotal() {
    const adults = parseInt(document.querySelector('[name="adults"]').value) || 0;
    const children = parseInt(document.querySelector('[name="children"]').value) || 0;
    const total = (adults + children) * packagePrice;
    
    document.getElementById('totalAmount').textContent = '₹' + total.toLocaleString();
    document.getElementById('btnText').textContent = 'Book & Pay - ₹' + total.toLocaleString();
}

function showAlert(message, type = 'error') {
    const alertContainer = document.getElementById('alertContainer');
    const alertMessage = document.getElementById('alertMessage');
    
    alertContainer.classList.remove('hidden');
    alertMessage.className = `p-4 rounded-lg ${type === 'success' ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200'}`;
    alertMessage.textContent = message;
    
    setTimeout(() => {
        alertContainer.classList.add('hidden');
    }, 5000);
}

document.getElementById('bookingForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const bookingBtn = document.getElementById('bookingBtn');
    const btnText = document.getElementById('btnText');
    const btnLoader = document.getElementById('btnLoader');
    
    // Show loading state
    bookingBtn.disabled = true;
    btnText.classList.add('hidden');
    btnLoader.classList.remove('hidden');
    
    try {
        const formData = new FormData(this);
        
        console.log('Creating booking with data:', Object.fromEntries(formData));
        
        const response = await fetch('{{ route("bookings.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(Object.fromEntries(formData))
        });
        
        const result = await response.json();
        console.log('Booking response:', result);
        
        if (result.success && result.payment_data) {
            console.log('Booking created successfully, initializing payment...');
            
            // Initialize Razorpay payment
            const options = {
                key: result.payment_data.key,
                amount: result.payment_data.amount,
                currency: result.payment_data.currency,
                order_id: result.payment_data.order_id,
                name: 'MyBirBilling',
                description: 'Package Booking Payment',
                handler: function(response) {
                    console.log('Payment successful:', response);
                    
                    // Send payment details to server
                    const callbackForm = document.createElement('form');
                    callbackForm.method = 'POST';
                    callbackForm.action = '{{ route("payments.callback") }}';
                    
                    const fields = {
                        '_token': document.querySelector('[name="_token"]').value,
                        'razorpay_payment_id': response.razorpay_payment_id,
                        'razorpay_order_id': response.razorpay_order_id,
                        'razorpay_signature': response.razorpay_signature
                    };
                    
                    Object.keys(fields).forEach(key => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = key;
                        input.value = fields[key];
                        callbackForm.appendChild(input);
                    });
                    
                    document.body.appendChild(callbackForm);
                    callbackForm.submit();
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
                        console.log('Payment modal dismissed');
                        // Reset button state
                        bookingBtn.disabled = false;
                        btnText.classList.remove('hidden');
                        btnLoader.classList.add('hidden');
                    }
                }
            };
            
            const rzp = new Razorpay(options);
            rzp.open();
            
        } else {
            throw new Error(result.message || 'Failed to create booking');
        }
        
    } catch (error) {
        console.error('Booking error:', error);
        showAlert(error.message || 'Failed to create booking');
        
        // Reset button state
        bookingBtn.disabled = false;
        btnText.classList.remove('hidden');
        btnLoader.classList.add('hidden');
    }
});

// Initialize total calculation
calculateTotal();
</script>
@endsection
