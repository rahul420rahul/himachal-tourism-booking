<div class="container mx-auto px-4 pb-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-semibold mb-6">Book This Package</h2>
        
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <h4 class="font-semibold text-blue-900 mb-3">Payment Information</h4>
            <div class="space-y-2" id="paymentInfo">
                <div class="flex justify-between items-center">
                    <span class="text-gray-700">Duration:</span>
                    <span class="font-medium">{{ $package->duration }} {{ $package->category == 'training' ? 'days' : 'minutes' }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-700">Price per person:</span>
                    <span class="font-medium">₹{{ number_format($package->price) }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-700">Total Amount:</span>
                    <span class="font-bold text-lg" id="totalAmount">₹{{ number_format($package->price) }}</span>
                </div>
                <div class="flex justify-between items-center text-green-600">
                    <span>Advance Payment:</span>
                    <span class="font-bold" id="advanceAmount">₹0</span>
                </div>
                <div class="flex justify-between items-center text-orange-600">
                    <span>Balance (at venue):</span>
                    <span class="font-bold" id="pendingAmount">₹0</span>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('bookings.store') }}" id="bookingForm">
            @csrf
            <input type="hidden" name="package_id" value="{{ $package->id }}">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Travel Date</label>
                    <input type="date" name="booking_date" required 
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                           min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                </div>
                
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Adults</label>
                        <select name="adults" required id="adultsSelect"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            @for($i = 1; $i <= min(10, $package->max_participants); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Children</label>
                        <select name="children" id="childrenSelect"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            @for($i = 0; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="guest_name" required 
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="guest_email" required 
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                <input type="tel" name="guest_phone" required 
                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                       pattern="[0-9]{10}" title="Enter 10-digit phone number">
            </div>
            
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Special Requests</label>
                <textarea name="special_requests" rows="3" 
                          class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
            
            <button type="submit" id="bookBtn" 
                    class="w-full bg-green-600 text-white py-4 rounded-lg font-semibold hover:bg-green-700">
                <span id="btnText">Pay Advance - ₹0</span>
                <span id="btnLoader" class="hidden">Processing...</span>
            </button>
        </form>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
const packagePrice = {{ $package->price }};

function calculateAmount() {
    const adults = parseInt(document.getElementById('adultsSelect').value) || 0;
    const children = parseInt(document.getElementById('childrenSelect').value) || 0;
    const total = (adults + children) * packagePrice;
    const advance = Math.round(total * 0.2); // 20% advance
    const pending = total - advance;
    
    document.getElementById('totalAmount').textContent = '₹' + total.toLocaleString();
    document.getElementById('advanceAmount').textContent = '₹' + advance.toLocaleString();
    document.getElementById('pendingAmount').textContent = '₹' + pending.toLocaleString();
    document.getElementById('btnText').textContent = 'Pay Advance - ₹' + advance.toLocaleString();
}

document.getElementById('adultsSelect').addEventListener('change', calculateAmount);
document.getElementById('childrenSelect').addEventListener('change', calculateAmount);
calculateAmount(); // Initial calculation

document.getElementById('bookingForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const btn = document.getElementById('bookBtn');
    const btnText = document.getElementById('btnText');
    const btnLoader = document.getElementById('btnLoader');
    
    // Show loading
    btn.disabled = true;
    btnText.classList.add('hidden');
    btnLoader.classList.remove('hidden');
    
    try {
        const formData = new FormData(this);
        
        const response = await fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        });
        
        const result = await response.json();
        console.log('Response:', result);
        
        if (result.success && result.payment_data) {
            const options = {
                key: result.payment_data.key,
                amount: result.payment_data.amount,
                currency: 'INR',
                order_id: result.payment_data.order_id,
                name: 'MyBirBilling',
                description: result.payment_data.description,
                prefill: result.payment_data.prefill,
                handler: function(response) {
                    alert('Payment successful!');
                    window.location.href = '/bookings/' + result.booking_id + '/guest';
                },
                modal: {
                    ondismiss: function() {
                        btn.disabled = false;
                        btnText.classList.remove('hidden');
                        btnLoader.classList.add('hidden');
                    }
                }
            };
            
            const rzp = new Razorpay(options);
            rzp.open();
        } else {
            throw new Error(result.message || 'Booking failed');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error: ' + error.message);
        
        // Reset button
        btn.disabled = false;
        btnText.classList.remove('hidden');
        btnLoader.classList.add('hidden');
    }
});
</script>
