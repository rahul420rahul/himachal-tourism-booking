<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\User;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Invoice::with(['user', 'booking', 'items']);

        // Filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->filled('customer_email')) {
            $query->where('customer_email', 'like', '%' . $request->customer_email . '%');
        }

        if ($request->filled('date_from')) {
            $query->where('invoice_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('invoice_date', '<=', $request->date_to);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%");
            });
        }

        $invoices = $query->orderBy('created_at', 'desc')->paginate(15);

        // Statistics
        $stats = [
            'total_invoices' => Invoice::count(),
            'paid_invoices' => Invoice::where('payment_status', 'paid')->count(),
            'pending_invoices' => Invoice::where('payment_status', 'unpaid')->count(),
            'overdue_invoices' => Invoice::where('status', 'overdue')->count(),
            'total_revenue' => Invoice::where('payment_status', 'paid')->sum('total_amount'),
            'pending_amount' => Invoice::where('payment_status', '!=', 'paid')->sum('balance_amount'),
        ];

        return view('invoices.index', compact('invoices', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $customers = User::all();
        $bookings = Booking::with('user')->where('status', 'confirmed')->get();
        
        // If booking_id is provided, pre-fill data
        $booking = null;
        if ($request->filled('booking_id')) {
            $booking = Booking::with('user')->find($request->booking_id);
        }

        return view('invoices.create', compact('customers', 'bookings', 'booking'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'customer_address' => 'nullable|string',
            'customer_gstin' => 'nullable|string|max:15',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'discount_amount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'terms_conditions' => 'nullable|string',
            'is_recurring' => 'boolean',
            'recurring_period' => 'nullable|in:monthly,quarterly,yearly',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.tax_rate' => 'nullable|numeric|min:0|max:100',
            'items.*.discount_rate' => 'nullable|numeric|min:0|max:100',
        ]);

        DB::transaction(function () use ($request) {
            // Generate invoice number
            $invoiceNumber = $this->generateInvoiceNumber();

            // Create invoice
            $invoice = Invoice::create([
                'invoice_number' => $invoiceNumber,
                'user_id' => $request->user_id,
                'booking_id' => $request->booking_id,
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'customer_gstin' => $request->customer_gstin,
                'invoice_date' => $request->invoice_date,
                'due_date' => $request->due_date,
                'tax_rate' => $request->tax_rate ?? 0,
                'discount_amount' => $request->discount_amount ?? 0,
                'notes' => $request->notes,
                'terms_conditions' => $request->terms_conditions,
                'is_recurring' => $request->is_recurring ?? false,
                'recurring_period' => $request->recurring_period,
                'next_invoice_date' => $this->calculateNextInvoiceDate($request->due_date, $request->recurring_period),
                'total_amount' => 0, // Will be calculated after items
            ]);

            // Create invoice items and calculate totals
            $this->createItemsAndCalculate($invoice, $request->items);

            session()->flash('success', 'Invoice created successfully!');
            return $invoice;
        });

        return redirect()->route('invoices.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $invoice->load(['user', 'booking', 'items', 'payments']);
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        if ($invoice->status === 'paid') {
            return redirect()->route('invoices.show', $invoice)
                           ->with('error', 'Cannot edit paid invoice.');
        }

        $customers = User::all();
        $bookings = Booking::with('user')->get();
        $invoice->load('items');

        return view('invoices.edit', compact('invoice', 'customers', 'bookings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        if ($invoice->status === 'paid') {
            return redirect()->route('invoices.show', $invoice)
                           ->with('error', 'Cannot update paid invoice.');
        }

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request, $invoice) {
            // Delete existing items
            $invoice->items()->delete();

            // Update invoice
            $invoice->update([
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'customer_gstin' => $request->customer_gstin,
                'invoice_date' => $request->invoice_date,
                'due_date' => $request->due_date,
                'tax_rate' => $request->tax_rate ?? 0,
                'discount_amount' => $request->discount_amount ?? 0,
                'notes' => $request->notes,
                'terms_conditions' => $request->terms_conditions,
            ]);

            // Re-create items and recalculate totals
            $this->createItemsAndCalculate($invoice, $request->items);
        });

        return redirect()->route('invoices.show', $invoice)
                        ->with('success', 'Invoice updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        if ($invoice->status === 'paid') {
            return redirect()->route('invoices.index')
                           ->with('error', 'Cannot delete paid invoice.');
        }

        $invoice->delete();
        
        return redirect()->route('invoices.index')
                        ->with('success', 'Invoice deleted successfully!');
    }

    /**
     * Generate PDF for invoice
     */
    public function downloadPdf(Invoice $invoice)
    {
        $invoice->load(['items', 'user', 'booking']);
        
        $pdf = Pdf::loadView('invoices.pdf', compact('invoice'));
        
        return $pdf->download('invoice-' . $invoice->invoice_number . '.pdf');
    }

    /**
     * Send invoice via email
     */
    public function sendEmail(Invoice $invoice)
    {
        try {
            $invoice->sendInvoice();
            
            // Here you would implement email sending
            // Mail::to($invoice->customer_email)->send(new InvoiceMail($invoice));
            
            return redirect()->back()->with('success', 'Invoice sent successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send invoice: ' . $e->getMessage());
        }
    }

    /**
     * Mark invoice as paid
     */
    public function markAsPaid(Invoice $invoice, Request $request)
    {
        $request->validate([
            'payment_amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|string',
            'transaction_id' => 'nullable|string',
        ]);

        DB::transaction(function () use ($invoice, $request) {
            $invoice->markAsPaid($request->payment_amount);
            
            // Create payment record
            Payment::create([
                'booking_id' => $invoice->booking_id,
                'user_id' => $invoice->user_id,
                'amount' => $request->payment_amount,
                'payment_method' => $request->payment_method,
                'transaction_id' => $request->transaction_id,
                'status' => 'completed',
                'razorpay_order_id' => $request->razorpay_order_id ?? null,
                'razorpay_payment_id' => $request->razorpay_payment_id ?? null,
            ]);
        });

        return redirect()->back()->with('success', 'Payment recorded successfully!');
    }

    /**
     * Duplicate invoice
     */
    public function duplicate(Invoice $invoice)
    {
        $newInvoice = null;
        
        DB::transaction(function () use ($invoice, &$newInvoice) {
            $newInvoice = $invoice->replicate();
            $newInvoice->invoice_number = $this->generateInvoiceNumber();
            $newInvoice->status = 'draft';
            $newInvoice->payment_status = 'unpaid';
            $newInvoice->paid_amount = 0;
            $newInvoice->balance_amount = $newInvoice->total_amount;
            $newInvoice->sent_at = null;
            $newInvoice->paid_at = null;
            $newInvoice->invoice_date = now()->format('Y-m-d');
            $newInvoice->due_date = now()->addDays(30)->format('Y-m-d');
            $newInvoice->save();

            // Duplicate items
            foreach ($invoice->items as $item) {
                $newItem = $item->replicate();
                $newItem->invoice_id = $newInvoice->id;
                $newItem->save();
            }
        });

        return redirect()->route('invoices.show', $newInvoice)
                        ->with('success', 'Invoice duplicated successfully!');
    }

    /**
     * Public view for guests with token
     */
    public function publicView(Invoice $invoice, $token)
    {
        // Simple token check (you can implement more secure token system)
        $expectedToken = md5($invoice->id . $invoice->customer_email . $invoice->created_at);
        
        if ($token !== $expectedToken) {
            abort(404);
        }
        
        $invoice->load('items');
        return view('invoices.public', compact('invoice'));
    }

    /**
     * Public download for guests with token
     */
    public function publicDownload(Invoice $invoice, $token)
    {
        $expectedToken = md5($invoice->id . $invoice->customer_email . $invoice->created_at);
        
        if ($token !== $expectedToken) {
            abort(404);
        }
        
        return $this->downloadPdf($invoice);
    }

    /**
     * Get invoice statistics for dashboard
     */
    public function getStats()
    {
        $stats = [
            'total' => Invoice::count(),
            'paid' => Invoice::where('payment_status', 'paid')->count(),
            'pending' => Invoice::where('payment_status', 'unpaid')->count(),
            'overdue' => Invoice::overdue()->count(),
            'revenue' => Invoice::paid()->sum('total_amount'),
            'pending_amount' => Invoice::unpaid()->sum('total_amount'),
            'monthly_revenue' => Invoice::paid()
                               ->whereMonth('paid_at', now()->month)
                               ->sum('total_amount'),
            'this_month' => Invoice::whereMonth('created_at', now()->month)->count(),
        ];

        return response()->json($stats);
    }

    // Helper methods
    private function generateInvoiceNumber()
    {
        $lastInvoice = Invoice::orderBy('id', 'desc')->first();
        $nextNumber = $lastInvoice ? ($lastInvoice->id + 1) : 1;
        return 'INV-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }

    private function calculateNextInvoiceDate($dueDate, $period)
    {
        if (!$period) return null;
        
        $date = Carbon::parse($dueDate);
        
        return match($period) {
            'monthly' => $date->addMonth(),
            'quarterly' => $date->addMonths(3),
            'yearly' => $date->addYear(),
            default => null,
        };
    }

    private function createItemsAndCalculate($invoice, $items)
    {
        $subtotal = 0;
        
        foreach ($items as $itemData) {
            $quantity = (int) $itemData['quantity'];
            $unitPrice = (float) $itemData['unit_price'];
            $discountRate = (float) ($itemData['discount_rate'] ?? 0);
            $taxRate = (float) ($itemData['tax_rate'] ?? 0);

            $itemSubtotal = $quantity * $unitPrice;
            $discountAmount = ($itemSubtotal * $discountRate) / 100;
            $taxableAmount = $itemSubtotal - $discountAmount;
            $taxAmount = ($taxableAmount * $taxRate) / 100;
            $totalPrice = $taxableAmount + $taxAmount;

            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'description' => $itemData['description'],
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'item_code' => $itemData['item_code'] ?? null,
                'hsn_sac_code' => $itemData['hsn_sac_code'] ?? null,
                'tax_rate' => $taxRate,
                'tax_amount' => $taxAmount,
                'discount_rate' => $discountRate,
                'discount_amount' => $discountAmount,
                'total_price' => $totalPrice,
            ]);

            $subtotal += $totalPrice;
        }

        // Calculate final amounts
        $invoiceTaxAmount = ($subtotal * $invoice->tax_rate) / 100;
        $finalAmount = $subtotal + $invoiceTaxAmount - $invoice->discount_amount;

        $invoice->update([
            'subtotal' => $subtotal,
            'tax_amount' => $invoiceTaxAmount,
            'total_amount' => $finalAmount,
            'balance_amount' => $finalAmount - $invoice->paid_amount,
        ]);
    }
}
