@extends('layouts.app')

@section('title', $title ?? 'Safety Guidelines')

@push('styles')
<style>
  html { scroll-behavior: smooth; }
  .sg-hero {
    background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
    color: #fff;
    border-radius: 1rem;
  }
  .sg-section h2 { scroll-margin-top: 6rem; }
  .sg-toc {
    position: sticky; top: 6rem; max-height: calc(100vh - 7rem); overflow: auto;
  }
  .check-list li::marker { content: '✔️ '; }
  .sg-meta .badge { font-weight: 500; }
  .icon { width: 1.25rem; height: 1.25rem; vertical-align: -0.2rem; }
  .toc-link { text-decoration: none; }
  .toc-link:hover { text-decoration: underline; }
</style>
@endpush

@section('content')
<div class="container py-4">
  <div class="row g-4">

    <!-- Header / Hero -->
    <div class="col-12">
      <div class="p-4 p-md-5 sg-hero shadow-sm">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
          <div>
            <h1 class="h2 mb-2">{{ $title ?? 'Safety Guidelines' }}</h1>
            <div class="sg-meta d-flex flex-wrap gap-2 align-items-center">
              <span class="badge bg-light text-dark">
                <span class="me-1">🕒</span>
                Last updated: {{ isset($updatedAt) ? \Carbon\Carbon::parse($updatedAt)->format('F d, Y') : now()->format('F d, Y') }}
              </span>
              <span class="badge bg-success">Security First</span>
              <span class="badge bg-warning text-dark">Read Carefully</span>
            </div>
          </div>
          <div class="d-flex gap-2">
            <a href="#reporting" class="btn btn-light">Report an Issue</a>
            <button class="btn btn-outline-light" onclick="window.print()">Print</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Sidebar TOC -->
    <div class="col-lg-4 col-xl-3">
      <div class="card shadow-sm">
        <div class="card-header bg-white fw-semibold">On this page</div>
        <div class="card-body sg-toc small">
          <ol class="mb-0 ps-3">
            <li><a class="toc-link" href="#account-security">Account Security</a></li>
            <li><a class="toc-link" href="#payment-security">Payment Security</a></li>
            <li><a class="toc-link" href="#online-safety">Online Safety</a></li>
            <li><a class="toc-link" href="#communication-safety">Communication Safety</a></li>
            <li><a class="toc-link" href="#reporting">Incident Reporting</a></li>
            <li><a class="toc-link" href="#data-protection">Data Protection</a></li>
            <li><a class="toc-link" href="#mobile-safety">Mobile Safety</a></li>
            <li><a class="toc-link" href="#business-account">Business Account Safety</a></li>
            <li><a class="toc-link" href="#support">Support & Assistance</a></li>
          </ol>
        </div>
      </div>

      <div class="alert alert-info mt-3 mb-0">
        <strong>Important:</strong> Your safety and security are our top priorities. Please read these guidelines carefully.
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-lg-8 col-xl-9">

      <div id="account-security" class="sg-section mb-4">
        <div class="card shadow-sm">
          <div class="card-header bg-white">
            <h2 class="h5 mb-0">🔐 Account Security</h2>
          </div>
          <div class="card-body">
            <h3 class="h6">Password Security</h3>
            <ul class="check-list">
              <li>Use a strong, unique password with at least 12 characters</li>
              <li>Include uppercase, lowercase, numbers, and special characters</li>
              <li>Never share your password with anyone</li>
              <li>Change your password if you suspect it has been compromised</li>
              <li>Enable two-factor authentication when available</li>
            </ul>

            <h3 class="h6 mt-4">Account Monitoring</h3>
            <ul class="check-list">
              <li>Regularly review your account activity</li>
              <li>Report any suspicious activity immediately</li>
              <li>Log out from shared or public computers</li>
              <li>Keep your contact information updated</li>
            </ul>
          </div>
        </div>
      </div>

      <div id="payment-security" class="sg-section mb-4">
        <div class="card shadow-sm">
          <div class="card-header bg-white">
            <h2 class="h5 mb-0">💳 Payment Security</h2>
          </div>
          <div class="card-body">
            <h3 class="h6">Safe Payment Practices</h3>
            <ul class="check-list">
              <li>Only make payments through our secure payment gateway</li>
              <li>Verify SSL encryption (look for the lock icon in your browser)</li>
              <li>Never share your credit card details via email or phone</li>
              <li>Review all charges on your statements</li>
              <li>Report unauthorized charges immediately</li>
            </ul>
            <h3 class="h6 mt-4">Billing Information</h3>
            <ul class="check-list">
              <li>Keep your billing information up to date</li>
              <li>Use secure networks for payment transactions</li>
              <li>Avoid public Wi‑Fi for sensitive transactions</li>
            </ul>
          </div>
        </div>
      </div>

      <div id="online-safety" class="sg-section mb-4">
        <div class="card shadow-sm">
          <div class="card-header bg-white">
            <h2 class="h5 mb-0">🌐 Online Safety</h2>
          </div>
          <div class="card-body">
            <h3 class="h6">Phishing Protection</h3>
            <ul class="check-list">
              <li>Always access our service directly through our official website</li>
              <li>Be wary of emails requesting personal information</li>
              <li>Verify sender authenticity before clicking links</li>
              <li>Never provide login credentials through email links</li>
            </ul>
            <h3 class="h6 mt-4">Safe Browsing</h3>
            <ul class="check-list">
              <li>Keep your browser and operating system updated</li>
              <li>Use reputable antivirus software</li>
              <li>Clear browser cache and cookies regularly</li>
              <li>Avoid downloading suspicious files or software</li>
            </ul>
          </div>
        </div>
      </div>

      <div id="communication-safety" class="sg-section mb-4">
        <div class="card shadow-sm">
          <div class="card-header bg-white">
            <h2 class="h5 mb-0">📧 Communication Safety</h2>
          </div>
          <div class="card-body">
            <h3 class="h6">Official Communications</h3>
            <ul class="check-list">
              <li>We will never ask for passwords via email or phone</li>
              <li>Official emails will come from <code>@mybilling.com</code> domains</li>
              <li>Important updates will be posted in your account dashboard</li>
              <li>Contact us directly if you're unsure about a communication</li>
            </ul>
          </div>
        </div>
      </div>

      <div id="reporting" class="sg-section mb-4">
        <div class="card shadow-sm">
          <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0">🚨 Incident Reporting</h2>
            <span class="badge bg-danger">Act Fast</span>
          </div>
          <div class="card-body">
            <h3 class="h6">What to Report</h3>
            <ul class="check-list">
              <li>Suspicious login attempts</li>
              <li>Unauthorized account changes</li>
              <li>Unexpected charges or transactions</li>
              <li>Phishing attempts or suspicious emails</li>
              <li>Technical security concerns</li>
            </ul>

            <h3 class="h6 mt-4">How to Report</h3>
            <div class="accordion" id="reportingAccordion">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#reportEmail" aria-expanded="true" aria-controls="reportEmail">
                    Email (Recommended)
                  </button>
                </h2>
                <div id="reportEmail" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#reportingAccordion">
                  <div class="accordion-body">
                    <ul class="mb-0">
                      <li>Email: <a href="mailto:security@mybilling.com">security@mybilling.com</a></li>
                      <li>Subject: <code>High Priority Security Issue</code></li>
                      <li>Include: account email, description, screenshots/logs (if any)</li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#reportPhone" aria-expanded="false" aria-controls="reportPhone">
                    24/7 Security Hotline
                  </button>
                </h2>
                <div id="reportPhone" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#reportingAccordion">
                  <div class="accordion-body">
                    <p class="mb-2">Phone: <a href="tel:+910000000000">+91-XXXXXXXXXX</a></p>
                    <p class="mb-0 small text-muted">For critical, time-sensitive incidents.</p>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#reportTicket" aria-expanded="false" aria-controls="reportTicket">
                    Support Ticket
                  </button>
                </h2>
                <div id="reportTicket" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#reportingAccordion">
                  <div class="accordion-body">
                    <p class="mb-2">Open a <strong>High Priority Security Issue</strong> from your dashboard.</p>
                    <ul class="mb-0">
                      <li>Category: Security</li>
                      <li>Priority: High</li>
                      <li>Attach relevant files (logs, screenshots)</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <div class="alert alert-warning mt-3 mb-0">
              <strong>Emergency Security Issues:</strong> Use the hotline above if your account is actively at risk.
            </div>
          </div>
        </div>
      </div>

      <div id="data-protection" class="sg-section mb-4">
        <div class="card shadow-sm">
          <div class="card-header bg-white">
            <h2 class="h5 mb-0">🛡️ Data Protection</h2>
          </div>
          <div class="card-body">
            <h3 class="h6">Personal Information</h3>
            <ul class="check-list">
              <li>Review and update your privacy settings regularly</li>
              <li>Limit sharing of personal information</li>
              <li>Use the minimum necessary permissions for integrations</li>
              <li>Regularly audit connected applications</li>
            </ul>
          </div>
        </div>
      </div>

      <div id="mobile-safety" class="sg-section mb-4">
        <div class="card shadow-sm">
          <div class="card-header bg-white">
            <h2 class="h5 mb-0">📱 Mobile Safety</h2>
          </div>
          <div class="card-body">
            <h3 class="h6">Mobile App Security</h3>
            <ul class="check-list">
              <li>Download our app only from official app stores</li>
              <li>Keep the app updated to the latest version</li>
              <li>Use device lock screens and biometric authentication</li>
              <li>Log out when using shared devices</li>
            </ul>
          </div>
        </div>
      </div>

      <div id="business-account" class="sg-section mb-4">
        <div class="card shadow-sm">
          <div class="card-header bg-white">
            <h2 class="h5 mb-0">🏢 Business Account Safety</h2>
          </div>
          <div class="card-body">
            <h3 class="h6">Team Access</h3>
            <ul class="check-list">
              <li>Use role-based access control</li>
              <li>Regularly review team member permissions</li>
              <li>Remove access for former employees immediately</li>
              <li>Monitor user activity logs</li>
            </ul>
          </div>
        </div>
      </div>

      <div id="support" class="sg-section mb-5">
        <div class="card shadow-sm">
          <div class="card-header bg-white">
            <h2 class="h5 mb-0">📞 Support & Assistance</h2>
          </div>
          <div class="card-body">
            <p>If you need help with any security concerns or have questions about these guidelines:</p>
            <div class="row g-3">
              <div class="col-md-6">
                <div class="border rounded p-3 h-100">
                  <div class="fw-semibold mb-1">General Support</div>
                  <a href="mailto:support@mybilling.com">support@mybilling.com</a>
                </div>
              </div>
              <div class="col-md-6">
                <div class="border rounded p-3 h-100">
                  <div class="fw-semibold mb-1">Security Issues</div>
                  <a href="mailto:security@mybilling.com">security@mybilling.com</a>
                </div>
              </div>
              <div class="col-md-6">
                <div class="border rounded p-3 h-100">
                  <div class="fw-semibold mb-1">Phone</div>
                  <a href="tel:+910000000000">+91-XXXXXXXXXX</a>
                </div>
              </div>
              <div class="col-md-6">
                <div class="border rounded p-3 h-100">
                  <div class="fw-semibold mb-1">Business Hours</div>
                  <div>Monday–Friday, 9:00 AM – 6:00 PM IST</div>
                </div>
              </div>
            </div>

            <div class="alert alert-success mt-4 mb-0">
              <strong>Remember:</strong> When in doubt, contact us. It's better to be safe than sorry when it comes to your security and privacy.
            </div>
          </div>
        </div>
      </div>

      <div class="text-end">
        <a href="#top" class="btn btn-outline-secondary">Back to top ↑</a>
      </div>

    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  // If Bootstrap JS is loaded, the accordion works automatically.
  // No extra JS needed; this block is here for future enhancements.
</script>
@endpush
