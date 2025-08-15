<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4; }
        .container { max-width: 600px; margin: 0 auto; background-color: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; }
        .content { padding: 30px; }
        .booking-details { background-color: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .detail-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #eee; }
        .detail-row:last-child { border-bottom: none; }
        .footer { background-color: #f8f9fa; padding: 20px; text-align: center; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 Booking Confirmed!</h1>
            <p>Thank you for choosing Bir Billing Adventures</p>
        </div>
        
        <div class="content">
            <p>Hello {{ $booking->name }}! 👋</p>
            <p>Your booking has been <strong>successfully confirmed</strong>. Get ready for an amazing adventure!</p>
            
            <div class="booking-details">
                <h3>📋 Booking Details</h3>
                
                <div class="detail-row">
                    <span><strong>Booking Number:</strong></span>
                    <span>{{ $booking->booking_number }}</span>
                </div>
                
                <div class="detail-row">
                    <span><strong>Package:</strong></span>
                    <span>{{ $booking->package->name }}</span>
                </div>
                
                <div class="detail-row">
                    <span><strong>Date:</strong></span>
                    <span>{{ \Carbon\Carbon::parse($booking->travel_date)->format('d M Y') }}</span>
                </div>
                
                <div class="detail-row">
                    <span><strong>Participants:</strong></span>
                    <span>{{ $booking->adults + $booking->children }} person(s)</span>
                </div>
                
                <div class="detail-row">
                    <span><strong>Total Amount:</strong></span>
                    <span><strong>₹{{ number_format($booking->total_amount, 2) }}</strong></span>
                </div>
                
                <div class="detail-row">
                    <span><strong>Payment Status:</strong></span>
                    <span style="color: green;"><strong>{{ strtoupper($booking->payment_status) }}</strong></span>
                </div>
            </div>
            
            <p><strong>What's Next?</strong></p>
            <ul>
                <li>Save this confirmation email for your records</li>
                <li>Our team will contact you 24-48 hours before your adventure</li>
                <li>Make sure to bring valid ID and comfortable clothing</li>
            </ul>
            
            <p>If you have any questions, feel free to contact us!</p>
        </div>
        
        <div class="footer">
            <p>Thank you for choosing MyBirBilling!</p>
            <p>📞 Contact: +91 98765 43210 | 📧 Email: info@mybirbilling.com</p>
        </div>
    </div>
</body>
</html>
