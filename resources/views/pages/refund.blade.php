@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>
                <div class="card-body">
                    <h1>Refund Policy</h1>
                    <p><strong>Last updated:</strong> {{ date('F d, Y') }}</p>
                    
                    <div class="alert alert-info">
                        <strong>Quick Summary:</strong> We offer refunds within 30 days of purchase for most services, subject to the conditions outlined below.
                    </div>

                    <h2>💰 Refund Eligibility</h2>
                    <h3>Eligible for Refund:</h3>
                    <ul>
                        <li>Monthly subscription fees (within 30 days of billing)</li>
                        <li>Annual subscription fees (within 30 days of billing)</li>
                        <li>One-time setup fees (within 30 days of purchase)</li>
                        <li>Premium features and add-ons (within 30 days of purchase)</li>
                        <li>Service downtime exceeding our SLA commitments</li>
                    </ul>

                    <h3>Not Eligible for Refund:</h3>
                    <ul>
                        <li>Usage-based charges (SMS, API calls, etc.) that have been consumed</li>
                        <li>Third-party service fees (payment gateway charges, etc.)</li>
                        <li>Custom development or consulting services</li>
                        <li>Requests made after 30 days from billing date</li>
                        <li>Account termination due to Terms of Service violation</li>
                    </ul>

                    <h2>⏰ Refund Timeframes</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">30-Day Money Back Guarantee</h5>
                                    <p class="card-text">Full refund available for subscription fees within 30 days of billing.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Pro-rated Refunds</h5>
                                    <p class="card-text">Annual subscriptions may receive pro-rated refunds after 30 days in special circumstances.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2>📋 Refund Process</h2>
                    <h3>How to Request a Refund:</h3>
                    <ol>
                        <li><strong>Contact Support:</strong> Email us at refunds@mybilling.com or create a support ticket</li>
                        <li><strong>Provide Details:</strong> Include your account email, billing reference, and reason for refund</li>
                        <li><strong>Review Process:</strong> Our team will review your request within 2-3 business days</li>
                        <li><strong>Decision:</strong> You'll receive an email with the refund decision</li>
                        <li><strong>Processing:</strong> Approved refunds are processed within 5-7 business days</li>
                    </ol>

                    <h3>Required Information:</h3>
                    <ul>
                        <li>Account email address</li>
                        <li>Invoice or transaction ID</li>
                        <li>Date of purchase/billing</li>
                        <li>Reason for refund request</li>
                        <li>Any relevant supporting documentation</li>
                    </ul>

                    <h2>💳 Refund Methods</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Original Payment Method</th>
                                <th>Refund Method</th>
                                <th>Processing Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Credit/Debit Card</td>
                                <td>Original card</td>
                                <td>5-10 business days</td>
                            </tr>
                            <tr>
                                <td>Bank Transfer/UPI</td>
                                <td>Bank account refund</td>
                                <td>3-7 business days</td>
                            </tr>
                            <tr>
                                <td>Digital Wallet</td>
                                <td>Wallet credit or bank transfer</td>
                                <td>2-5 business days</td>
                            </tr>
                            <tr>
                                <td>Net Banking</td>
                                <td>Bank account refund</td>
                                <td>3-7 business days</td>
                            </tr>
                        </tbody>
                    </table>

                    <h2>📊 Special Circumstances</h2>
                    <h3>Service Level Agreement (SLA) Violations:</h3>
                    <ul>
                        <li>Uptime falls below 99.5% in a billing period</li>
                        <li>Critical features unavailable for more than 4 hours</li>
                        <li>Data loss due to our system failures</li>
                        <li>Security breach affecting your account</li>
                    </ul>

                    <h3>Partial Refunds:</h3>
                    <p>In some cases, we may offer partial refunds for:</p>
                    <ul>
                        <li>Unused portion of annual subscriptions</li>
                        <li>Service degradation issues</li>
                        <li>Feature limitations not disclosed at purchase</li>
                    </ul>

                    <h2>🚫 Non-Refundable Items</h2>
                    <div class="alert alert-warning">
                        <h5>Please Note:</h5>
                        <ul class="mb-0">
                            <li>Third-party integration fees</li>
                            <li>Payment processing fees</li>
                            <li>SMS and communication credits used</li>
                            <li>API calls and usage-based charges</li>
                            <li>Custom reports and exports generated</li>
                        </ul>
                    </div>

                    <h2>🔄 Alternative Solutions</h2>
                    <p>Before processing a refund, we may offer:</p>
                    <ul>
                        <li><strong>Account Credit:</strong> Apply refund amount as account credit for future billing</li>
                        <li><strong>Plan Downgrade:</strong> Switch to a lower-tier plan with price adjustment</li>
                        <li><strong>Extended Trial:</strong> Additional trial period to evaluate the service</li>
                        <li><strong>Technical Support:</strong> Additional assistance to resolve any issues</li>
                    </ul>

                    <h2>📞 Contact Information</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Refund Requests</h5>
                                    <ul class="list-unstyled">
                                        <li><strong>Email:</strong> refunds@mybilling.com</li>
                                        <li><strong>Phone:</strong> +91-XXXXXXXXXX</li>
                                        <li><strong>Support Ticket:</strong> High Priority</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Business Hours</h5>
                                    <ul class="list-unstyled">
                                        <li><strong>Monday-Friday:</strong> 9:00 AM - 6:00 PM IST</li>
                                        <li><strong>Saturday:</strong> 10:00 AM - 2:00 PM IST</li>
                                        <li><strong>Sunday:</strong> Closed</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2>📜 Important Terms</h2>
                    <ul>
                        <li>Refunds are processed in the original currency of purchase</li>
                        <li>Bank/payment gateway charges may be deducted from refund amount</li>
                        <li>Refund policy may vary for enterprise and custom contracts</li>
                        <li>We reserve the right to refuse refunds for fraudulent accounts</li>
                        <li>This policy is subject to applicable local laws and regulations</li>
                    </ul>

                    <div class="alert alert-success">
                        <h5>Our Commitment</h5>
                        <p class="mb-0">We're committed to your satisfaction. If you're not happy with our service, we'll work with you to find a solution that works for everyone.</p>
                    </div>

                    <hr>
                    <p><small>This refund policy is part of our <a href="{{ route('terms') }}">Terms & Conditions</a>. For questions, please don't hesitate to contact our support team.</small></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
