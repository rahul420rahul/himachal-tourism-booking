@extends('layouts.app')

@section('title', 'Invoice #' . $invoice->invoice_number)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Actions -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <nav class="text-gray-500 mb-2">
                <a href="{{ route('home') }}" class="hover:text-blue-600">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('invoices.index') }}" class="hover:text-blue-600">Invoices</a>
                <span class="mx-2">/</span>
                <span class="text-gray-700">#{{ $invoice->invoice_number }}</span>
            </nav>
            <h1 class="text-3xl font-bold text-gray-800">Invoice #{{ $invoice->invoice_number }}</h1>
        </div>
        
        <div class="flex items-center space-x-3">
            <a href="{{ route('invoices.pdf', $invoice) }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-download mr-2"></i>Download PDF
            </a>
            
            @can('manage-system')
            <a href="{{ route('invoices.edit', $invoice) }}" 
               class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
            
            @if($invoice->status !== 'paid')
            <form method="POST" action="{{ route('invoices.pay', $invoice) }}" class="inline">
                @csrf
                <button type="submit" 
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition"
                        onclick="return confirm('Mark this invoice as paid?')">
                    <i class="fas fa-check-circle mr-2"></i>Mark as Paid
                </button>
            </form>
            @endif
            @endcan
        </div>
    </div>

    <!-- Invoice Content -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Invoice Header -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-8">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-2xl font-bold mb-2">MyBirBilling</h2>
                    <p class="opacity-90">Himachal Pradesh Tourism</p>
                    <p class="opacity-75 text-sm mt-2">
                        Billing, Himachal Pradesh<br>
                        Phone: +91-XXXXXXXXXX<br>
                        Email: info@mybirbilling.com
                    </p>
                </div>
                <div class="text-right">
                    <h1 class="text-3xl font-bold mb-2">INVOICE</h1>
                    <div class="space-y-1 text-sm opacity-90">
                        <p><strong>Invoice #:</strong> {{ $invoice->invoice_number }}</p>
                        <p><strong>Date:</strong> {{ $invoice->invoice_date->format('M d, Y') }}</p>
                        @if($invoice->due_date)
                        <p><strong>Due Date:</strong> {{ $invoice->due_date->format('M d, Y') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8">
            <!-- Bill To Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Bill To:</h3>
                    <div class="space-y-1 text-gray-600">
                        <p class="font-medium text-gray-800">{{ $invoice->customer_name }}</p>
                        <p>{{ $invoice->customer_email }}</p>
                        @if($invoice->customer_phone)
                        <p>{{ $invoice->customer_phone }}</p>
                        @endif
                        @if($invoice->customer_address)
                        <div class="mt-2">
                            {!! nl2br(e($invoice->customer_address)) !!}
                        </div>
                        @endif
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Invoice Details:</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            <span class="px-2 py-1 rounded text-xs font-medium
                                @if($invoice->status === 'paid') bg-green-100 text-green-800
                                @elseif($invoice->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($invoice->status === 'overdue') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($invoice->status) }}
                            </span>
                        </div>
                        @if($invoice->booking)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Booking ID:</span>
                            <span class="font-medium">#{{ $invoice->booking->id }}</span>
                        </div>
                        @endif
                        @if($invoice->paid_amount > 0)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Amount Paid:</span>
                            <span class="font-medium text-green-600">₹{{ number_format($invoice->paid_amount) }}</span>
                        </div>
                        @endif
                        @if($invoice->balance_due > 0)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Balance Due:</span>
                            <span class="font-medium text-red-600">₹{{ number_format($invoice->balance_due) }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Invoice Items -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Items & Services:</h3>
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200 rounded-lg">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Description</th>
                                <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">Quantity</th>
                                <th class="px-4 py-3 text-right text-sm font-medium text-gray-700">Unit Price</th>
                                <th class="px-4 py-3 text-right text-sm font-medium text-gray-700">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @if($invoice->items && count($invoice->items) > 0)
                                @foreach($invoice->items as $item)
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="font-medium text-gray-800">{{ $item['name'] }}</div>
                                        @if(isset($item['description']) && $item['description'])
                                        <div class="text-sm text-gray-600">{{ $item['description'] }}</div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">{{ $item['quantity'] ?? 1 }}</td>
                                    <td class="px-4 py-3 text-right">₹{{ number_format($item['unit_price'] ?? $item['price']) }}</td>
                                    <td class="px-4 py-3 text-right font-medium">₹{{ number_format(($item['quantity'] ?? 1) * ($item['unit_price'] ?? $item['price'])) }}</td>
                                </tr>
                                @endforeach
                            @elseif($invoice->booking && $invoice->booking->package)
                                <!-- Fallback to booking package if no items -->
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="font-medium text-gray-800">{{ $invoice->booking->package->name }}</div>
                                        <div class="text-sm text-gray-600">
                                            {{ $invoice->booking->package->duration }} Days Package
                                            @if($invoice->booking->guest_count > 1)
                                            - {{ $invoice->booking->guest_count }} Guests
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-center">{{ $invoice->booking->guest_count ?? 1 }}</td>
                                    <td class="px-4 py-3 text-right">₹{{ number_format($invoice->booking->package->price) }}</td>
                                    <td class="px-4 py-3 text-right font-medium">₹{{ number_format($invoice->booking->total_amount) }}</td>
                                </tr>
                            @else
                                <!-- Generic service item -->
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="font-medium text-gray-800">Travel Package Service</div>
                                        <div class="text-sm text-gray-600">Tourism services provided</div>
                                    </td>
                                    <td class="px-4 py-3 text-center">1</td>
                                    <td class="px-4 py-3 text-right">₹{{ number_format($invoice->total_amount) }}</td>
                                    <td class="px-4 py-3 text-right font-medium">₹{{ number_format($invoice->total_amount) }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Invoice Summary -->
            <div class="flex justify-end">
                <div class="w-full md:w-1/2 lg:w-1/3">
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Invoice Summary</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Subtotal:</span>
                                <span>₹{{ number_format($invoice->subtotal ?? $invoice->total_amount) }}</span>
                            </div>
                            
                            @if($invoice->tax_amount && $invoice->tax_amount > 0)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Tax ({{ $invoice->tax_rate ?? 18 }}%):</span>
                                <span>₹{{ number_format($invoice->tax_amount) }}</span>
                            </div>
                            @endif
                            
                            @if($invoice->discount_amount && $invoice->discount_amount > 0)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Discount:</span>
                                <span class="text-red-600">-₹{{ number_format($invoice->discount_amount) }}</span>
                            </div>
                            @endif
                            
                            <div class="border-t pt-2 flex justify-between font-semibold text-lg">
                                <span>Total Amount:</span>
                                <span class="text-blue-600">₹{{ number_format($invoice->total_amount) }}</span>
                            </div>
                            
                            @if($invoice->paid_amount > 0)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Amount Paid:</span>
                                <span class="text-green-600">₹{{ number_format($invoice->paid_amount) }}</span>
                            </div>
                            <div class="flex justify-between font-medium text-red-600">
                                <span>Balance Due:</span>
                                <span>₹{{ number_format($invoice->total_amount - $invoice->paid_amount) }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            @if($invoice->notes)
            <div class="mt-8 p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded">
                <h4 class="font-semibold text-yellow-800 mb-2">Notes:</h4>
                <p class="text-yellow-700">{!! nl2br(e($invoice->notes)) !!}</p>
            </div>
            @endif

            <!-- Payment Instructions -->
            @if($invoice->status !== 'paid')
            <div class="mt-8 p-4 bg-blue-50 border-l-4 border-blue-400 rounded">
                <h4 class="font-semibold text-blue-800 mb-2">Payment Instructions:</h4>
                <div class="text-blue-700 text-sm space-y-1">
                    <p>• Payment can be made online through our secure payment gateway</p>
                    <p>• Bank transfers are also accepted - contact us for account details</p>
                    <p>• Please include invoice number in payment reference</p>
                    <p>• For queries, contact us at info@mybirbilling.com</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
