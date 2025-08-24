@extends('layouts.app')

@section('styles')
<style>
    .privacy-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 40px 0;
    }
    
    .privacy-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: none;
        overflow: hidden;
    }
    
    .privacy-header {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 40px;
        text-align: center;
        position: relative;
    }
    
    .privacy-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="25" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="25" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
        opacity: 0.3;
    }
    
    .privacy-header h1 {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 15px;
        text-shadow: 0 4px 8px rgba(0,0,0,0.2);
        position: relative;
        z-index: 1;
    }
    
    .privacy-header .subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 10px;
        position: relative;
        z-index: 1;
    }
    
    .last-updated {
        background: rgba(255, 255, 255, 0.2);
        padding: 8px 20px;
        border-radius: 25px;
        display: inline-block;
        font-weight: 500;
        position: relative;
        z-index: 1;
    }
    
    .privacy-content {
        padding: 50px;
        line-height: 1.8;
        color: #2d3748;
    }
    
    .section {
        margin-bottom: 40px;
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.6s ease forwards;
    }
    
    .section:nth-child(1) { animation-delay: 0.1s; }
    .section:nth-child(2) { animation-delay: 0.2s; }
    .section:nth-child(3) { animation-delay: 0.3s; }
    .section:nth-child(4) { animation-delay: 0.4s; }
    .section:nth-child(5) { animation-delay: 0.5s; }
    .section:nth-child(6) { animation-delay: 0.6s; }
    .section:nth-child(7) { animation-delay: 0.7s; }
    .section:nth-child(8) { animation-delay: 0.8s; }
    
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .section-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #667eea;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        padding-bottom: 10px;
        border-bottom: 3px solid #667eea;
        position: relative;
    }
    
    .section-title::before {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 0;
        width: 50px;
        height: 3px;
        background: #764ba2;
    }
    
    .section-icon {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }
    
    .section-content p {
        font-size: 1.1rem;
        margin-bottom: 15px;
        text-align: justify;
    }
    
    .highlight-list {
        background: #f8fafc;
        border-radius: 15px;
        padding: 25px;
        margin: 20px 0;
        border-left: 5px solid #667eea;
    }
    
    .highlight-list ul {
        margin: 0;
        padding-left: 20px;
    }
    
    .highlight-list li {
        margin-bottom: 10px;
        font-size: 1.05rem;
        position: relative;
    }
    
    .highlight-list li::marker {
        color: #667eea;
    }
    
    .important-note {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 25px;
        border-radius: 15px;
        margin: 25px 0;
        text-align: center;
    }
    
    .important-note h4 {
        margin-bottom: 15px;
        font-size: 1.3rem;
        font-weight: 600;
    }
    
    .contact-card {
        background: #f8fafc;
        border-radius: 15px;
        padding: 30px;
        margin-top: 20px;
        border: 1px solid #e2e8f0;
    }
    
    .contact-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }
    
    .contact-item {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: center;
        gap: 15px;
        transition: transform 0.2s ease;
    }
    
    .contact-item:hover {
        transform: translateY(-3px);
    }
    
    .contact-icon {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
    
    .contact-info h5 {
        margin: 0;
        font-weight: 600;
        color: #2d3748;
    }
    
    .contact-info p {
        margin: 5px 0 0 0;
        color: #718096;
        font-size: 0.95rem;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .privacy-content {
            padding: 30px 25px;
        }
        
        .privacy-header {
            padding: 30px 20px;
        }
        
        .privacy-header h1 {
            font-size: 2.2rem;
        }
        
        .section-title {
            font-size: 1.5rem;
            flex-direction: column;
            text-align: center;
            gap: 10px;
        }
        
        .contact-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="privacy-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="privacy-card">
                    <!-- Header -->
                    <div class="privacy-header">
                        <h1>Privacy Policy</h1>
                        <p class="subtitle">Your privacy is important to us at MyBirBilling</p>
                        <div class="last-updated">
                            <strong>Last updated:</strong> {{ date('F d, Y') }}
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="privacy-content">
                        <!-- Section 1: Information We Collect -->
                        <div class="section">
                            <h2 class="section-title">
                                <div class="section-icon">📋</div>
                                1. Information We Collect
                            </h2>
                            <div class="section-content">
                                <p>At MyBirBilling, we collect information to provide better services to our users. We collect information in the following ways:</p>
                                <div class="highlight-list">
                                    <ul>
                                        <li><strong>Personal Information:</strong> Name, email address, phone number, and billing address</li>
                                        <li><strong>Account Information:</strong> Username, password, and account preferences</li>
                                        <li><strong>Billing Information:</strong> Payment details, transaction history, and invoices</li>
                                        <li><strong>Usage Data:</strong> How you interact with our paragliding and billing services</li>
                                        <li><strong>Device Information:</strong> IP address, browser type, and operating system</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: How We Use Your Information -->
                        <div class="section">
                            <h2 class="section-title">
                                <div class="section-icon">🔧</div>
                                2. How We Use Your Information
                            </h2>
                            <div class="section-content">
                                <p>We use your information to enhance your experience with MyBirBilling and provide quality paragliding services:</p>
                                <div class="highlight-list">
                                    <ul>
                                        <li>Process bookings and manage your paragliding sessions</li>
                                        <li>Generate and send invoices and billing statements</li>
                                        <li>Provide customer support and respond to your inquiries</li>
                                        <li>Send important updates about our services and safety information</li>
                                        <li>Improve our website, services, and user experience</li>
                                        <li>Ensure safety compliance and maintain service quality</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Information Sharing -->
                        <div class="section">
                            <h2 class="section-title">
                                <div class="section-icon">🔒</div>
                                3. Information Sharing and Disclosure
                            </h2>
                            <div class="section-content">
                                <p>Your privacy is our priority. We do not sell, rent, or share your personal information with third parties except in these limited circumstances:</p>
                                <div class="highlight-list">
                                    <ul>
                                        <li><strong>Service Providers:</strong> Trusted partners who help us operate our business (payment processors, email services)</li>
                                        <li><strong>Legal Requirements:</strong> When required by law, court order, or to protect our legal rights</li>
                                        <li><strong>Safety Purposes:</strong> Emergency situations or safety-related incidents</li>
                                        <li><strong>Business Transfers:</strong> In case of merger, acquisition, or sale of our business</li>
                                    </ul>
                                </div>
                                <div class="important-note">
                                    <h4>🛡️ Your Consent Matters</h4>
                                    <p>We will always ask for your explicit consent before sharing your information for any other purposes.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Section 4: Data Security -->
                        <div class="section">
                            <h2 class="section-title">
                                <div class="section-icon">🛡️</div>
                                4. Data Security
                            </h2>
                            <div class="section-content">
                                <p>We implement industry-standard security measures to protect your personal information:</p>
                                <div class="highlight-list">
                                    <ul>
                                        <li>SSL encryption for all data transmission</li>
                                        <li>Secure payment processing through trusted gateways</li>
                                        <li>Regular security audits and updates</li>
                                        <li>Access controls and employee training</li>
                                        <li>Secure data storage and backup systems</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Section 5: Your Rights -->
                        <div class="section">
                            <h2 class="section-title">
                                <div class="section-icon">⚖️</div>
                                5. Your Rights and Choices
                            </h2>
                            <div class="section-content">
                                <p>You have complete control over your personal information. You can:</p>
                                <div class="highlight-list">
                                    <ul>
                                        <li><strong>Access:</strong> Request a copy of your personal data</li>
                                        <li><strong>Update:</strong> Modify or correct your information at any time</li>
                                        <li><strong>Delete:</strong> Request deletion of your account and data</li>
                                        <li><strong>Opt-out:</strong> Unsubscribe from marketing communications</li>
                                        <li><strong>Portability:</strong> Download your data in a portable format</li>
                                        <li><strong>Object:</strong> Object to certain uses of your information</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Section 6: Cookies -->
                        <div class="section">
                            <h2 class="section-title">
                                <div class="section-icon">🍪</div>
                                6. Cookies and Tracking
                            </h2>
                            <div class="section-content">
                                <p>We use cookies and similar technologies to enhance your browsing experience and analyze website usage:</p>
                                <div class="highlight-list">
                                    <ul>
                                        <li><strong>Essential Cookies:</strong> Required for website functionality</li>
                                        <li><strong>Analytics Cookies:</strong> Help us understand how you use our site</li>
                                        <li><strong>Preference Cookies:</strong> Remember your settings and preferences</li>
                                    </ul>
                                </div>
                                <p>You can control cookie settings through your browser preferences or contact us for assistance.</p>
                            </div>
                        </div>

                        <!-- Section 7: Children's Privacy -->
                        <div class="section">
                            <h2 class="section-title">
                                <div class="section-icon">👶</div>
                                7. Children's Privacy
                            </h2>
                            <div class="section-content">
                                <p>Our paragliding services are designed for adults and individuals over 18 years of age. We do not knowingly collect personal information from children under 13. If we become aware that we have collected personal information from a child under 13, we will take steps to delete such information promptly.</p>
                                <div class="important-note">
                                    <h4>⚠️ Parental Guidance</h4>
                                    <p>Minors (under 18) must have parental consent and supervision for paragliding activities.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Section 8: Contact Us -->
                        <div class="section">
                            <h2 class="section-title">
                                <div class="section-icon">📞</div>
                                8. Contact Information
                            </h2>
                            <div class="section-content">
                                <p>If you have any questions, concerns, or requests regarding this Privacy Policy or how we handle your personal information, please don't hesitate to contact us:</p>
                                
                                <div class="contact-card">
                                    <h4 style="text-align: center; margin-bottom: 25px; color: #2d3748;">Get in Touch</h4>
                                    <div class="contact-grid">
                                        <div class="contact-item">
                                            <div class="contact-icon">📧</div>
                                            <div class="contact-info">
                                                <h5>Email Support</h5>
                                                <p>privacy@mybirbilling.com</p>
                                            </div>
                                        </div>
                                        
                                        <div class="contact-item">
                                            <div class="contact-icon">📞</div>
                                            <div class="contact-info">
                                                <h5>Phone Support</h5>
                                                <p>+91-98765-43210</p>
                                            </div>
                                        </div>
                                        
                                        <div class="contact-item">
                                            <div class="contact-icon">📍</div>
                                            <div class="contact-info">
                                                <h5>Visit Us</h5>
                                                <p>Billing, Himachal Pradesh, India</p>
                                            </div>
                                        </div>
                                        
                                        <div class="contact-item">
                                            <div class="contact-icon">⏰</div>
                                            <div class="contact-info">
                                                <h5>Response Time</h5>
                                                <p>Within 24-48 hours</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="important-note">
                                    <h4>🤝 We're Here to Help</h4>
                                    <p>Your privacy concerns are important to us. We're committed to addressing any questions or issues you may have about how we protect your personal information.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection