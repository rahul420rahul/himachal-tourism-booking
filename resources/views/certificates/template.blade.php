<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page { size: A4 landscape; margin: 0; }
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
        }
        .certificate {
            width: 297mm;
            height: 210mm;
            padding: 20mm;
            box-sizing: border-box;
            background: white;
            position: relative;
        }
        .border-frame {
            border: 3px solid #667eea;
            padding: 15mm;
            height: 100%;
            position: relative;
        }
        .header {
            text-align: center;
            margin-bottom: 20mm;
        }
        .title {
            font-size: 48px;
            color: #667eea;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .subtitle {
            font-size: 24px;
            color: #666;
        }
        .content {
            text-align: center;
            margin: 30mm 0;
        }
        .recipient {
            font-size: 36px;
            font-weight: bold;
            color: #333;
            margin: 20px 0;
        }
        .description {
            font-size: 18px;
            line-height: 1.6;
            color: #666;
        }
        .footer {
            position: absolute;
            bottom: 20mm;
            left: 20mm;
            right: 20mm;
            display: flex;
            justify-content: space-between;
        }
        .signature {
            text-align: center;
        }
        .qr-code {
            position: absolute;
            bottom: 25mm;
            right: 25mm;
            width: 80px;
            height: 80px;
        }
        .certificate-number {
            position: absolute;
            top: 15mm;
            right: 25mm;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="border-frame">
            <div class="certificate-number">
                Certificate No: {{ $certificate->certificate_number }}
            </div>
            
            <div class="header">
                <div class="title">CERTIFICATE OF ACHIEVEMENT</div>
                <div class="subtitle">Paragliding {{ $certificate->certificate_type }} Course</div>
            </div>
            
            <div class="content">
                <p class="description">This is to certify that</p>
                <div class="recipient">{{ $user->name }}</div>
                <p class="description">
                    has successfully completed the {{ $certificate->certificate_type }} Paragliding Course
                    and has demonstrated the required skills and knowledge
                    in accordance with international paragliding standards.
                </p>
                <p class="description" style="margin-top: 30px;">
                    <strong>Issue Date:</strong> {{ $certificate->issue_date->format('F d, Y') }}<br>
                    @if($certificate->expiry_date)
                    <strong>Valid Until:</strong> {{ $certificate->expiry_date->format('F d, Y') }}
                    @endif
                </p>
            </div>
            
            <div class="footer">
                <div class="signature">
                    <div style="border-top: 2px solid #333; width: 200px; margin: 0 auto;"></div>
                    <p style="margin-top: 10px;">Chief Instructor</p>
                </div>
                <div class="signature">
                    <div style="border-top: 2px solid #333; width: 200px; margin: 0 auto;"></div>
                    <p style="margin-top: 10px;">Director</p>
                </div>
            </div>
            
            @if($certificate->qr_code && file_exists($qrCodePath))
            <img src="{{ $qrCodePath }}" class="qr-code" alt="QR Code">
            @endif
        </div>
    </div>
</body>
</html>
