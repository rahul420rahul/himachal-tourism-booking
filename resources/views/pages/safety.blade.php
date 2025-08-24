@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>
                <div class="card-body">
                    <h1>Safety Guidelines</h1>
                    <p><strong>Last updated:</strong> {{ date('F d, Y') }}</p>
                    
                    <div class="alert alert-info">
                        <strong>Important:</strong> Your safety and security are our top priorities. Please read these guidelines carefully.
                    </div>

                    <h2>🔐 Account Security</h2>
                    <h3>Password Security</h3>
                    <ul>
                        <li>Use a strong, unique password with at least 8 characters</li>
                        <li>Include uppercase, lowercase, numbers, and special characters</li>
                        <li>Never share your password with anyone</li>
                        <li>Change your password if you suspect it has been compromised</li>
                        <li>Enable two-factor authentication when available</li>
                    </ul>

                    <h3>Account Monitoring</h3>
                    <ul>
                        <li>Regularly review your account activity</li>
                        <li>Report any suspicious activity immediately</li>
                        <li>Log out from shared or public computers</li>
                        <li>Keep your contact information updated</li>
                    </ul>

                    <h2>💳 Payment Security</h2>
                    <h3>Safe Payment Practices</h3>
                    <ul>
                        <li>Only make payments through our secure payment gateway</li>
                        <li>Verify SSL encryption (look for the lock icon in your browser)</li>
                        <li>Never share your credit card details via email or phone</li>
                        <li>Review all charges on your statements</li>
                        <li>Report unauthorized charges immediately</li>
                    </ul>

                    <h3>Billing Information</h3>
                    <ul>
                        <li>Keep your billing information up to date</li>
                        <li>Use secure networks for payment transactions</li>
                        <li>Avoid public Wi-Fi for sensitive transactions</li>
                    </ul>

                    <h2>🌐 Online Safety</h2>
                    <h3>Phishing Protection</h3>
                    <ul>
                        <li>Always access our service directly through our official website</li>
                        <li>Be wary of emails requesting personal information</li>
                        <li>Verify sender authenticity before clicking links</li>
                        <li>Never provide login credentials through email links</li>
                    </ul>

                    <h3>Safe Browsing</h3>
                    <ul>
                        <li>Keep your browser and operating system updated</li>
                        <li>Use reputable antivirus software</li>
                        <li>Clear browser cache and cookies regularly</li>
                        <li>Avoid downloading suspicious files or software</li>
                    </ul>

                    <h2>📧 Communication Safety</h2>
                    <h3>Official Communications</h3>
                    <ul>
                        <li>We will never ask for passwords via email or phone</li>
                        <li>Official emails will come from @mybilling.com domains</li>
                        <li>Important updates will be posted in your account dashboard</li>
                        <li>Contact us directly if you're unsure about a communication</li>
                    </ul>

                    <h2>🚨 Incident Reporting</h2>
                    <h3>What to Report</h3>
                    <ul>
                        <li>Suspicious login attempts</li>
                        <li>Unauthorized account changes</li>
                        <li>Unexpected charges or transactions</li>
                        <li>Phishing attempts or suspicious emails</li>
                        <li>Technical security concerns</li>
                    </ul>

                    <h3>How to Report</h3>
                    <div class="alert alert-warning">
                        <strong>Emergency Security Issues:</strong>
                        <ul class="mb-0">
                            <li>Email: security@mybilling.com</li>
                            <li>Phone: +91-XXXXXXXXXX (24/7 Security Hotline)</li>
                            <li>Support Ticket: High Priority Security Issue</li>
                        </ul>
                    </div>

                    <h2>🛡️ Data Protection</h2>
                    <h3>Personal Information</h3>
                    <ul>
                        <li>Review and update your privacy settings regularly</li>
                        <li>Limit sharing of personal information</li>
                        <li>Use the minimum necessary permissions for integrations</li>
                        <li>Regularly audit connected applications</li>
                    </ul>

                    <h2>📱 Mobile Safety</h2>
                    <h3>Mobile App Security</h3>
                    <ul>
                        <li>Download our app only from official app stores</li>
                        <li>Keep the app updated to the latest version</li>
                        <li>Use device lock screens and biometric authentication</li>
                        <li>Log out when using shared devices</li>
                    </ul>

                    <h2>🏢 Business Account Safety</h2>
                    <h3>Team Access</h3>
                    <ul>
                        <li>Use role-based access control</li>
                        <li>Regularly review team member permissions</li>
                        <li>Remove access for former employees immediately</li>
                        <li>Monitor user activity logs</li>
                    </ul>

                    <h2>📞 Support & Assistance</h2>
                    <p>If you need help with any security concerns or have questions about these guidelines:</p>
                    <ul>
                        <li><strong>General Support:</strong> support@mybilling.com</li>
                        <li><strong>Security Issues:</strong> security@mybilling.com</li>
                        <li><strong>Phone:</strong> +91-XXXXXXXXXX</li>
                        <li><strong>Business Hours:</strong> Monday-Friday, 9:00 AM - 6:00 PM IST</li>
                    </ul>

                    <div class="alert alert-success">
                        <strong>Remember:</strong> When in doubt, contact us. It's better to be safe than sorry when it comes to your security and privacy.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
