<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }
        .email-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        .email-body {
            padding: 40px 30px;
            color: #333333;
            line-height: 1.6;
        }
        .greeting {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        .message {
            font-size: 15px;
            color: #555555;
            margin-bottom: 30px;
        }
        .reset-button {
            display: inline-block;
            padding: 15px 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white !important;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
        }
        .reset-button:hover {
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
            transform: translateY(-2px);
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .alternative-link {
            margin-top: 30px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }
        .alternative-link p {
            margin: 0 0 10px 0;
            font-size: 13px;
            color: #666666;
        }
        .alternative-link a {
            word-break: break-all;
            color: #667eea;
            text-decoration: none;
            font-size: 12px;
        }
        .email-footer {
            background-color: #f8f9fa;
            padding: 30px;
            text-align: center;
            color: #999999;
            font-size: 13px;
            border-top: 1px solid #e0e0e0;
        }
        .warning {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .warning p {
            margin: 0;
            color: #856404;
            font-size: 14px;
        }
        .info-box {
            background-color: #e7f3ff;
            border-left: 4px solid #2196F3;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-box p {
            margin: 0;
            color: #0c5460;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>🔐 Reset Password</h1>
        </div>

        <!-- Body -->
        <div class="email-body">
            <p class="greeting">Halo, {{ $user->name }}!</p>
            
            <p class="message">
                Kami menerima permintaan untuk reset password akun Anda. Klik tombol di bawah ini untuk membuat password baru:
            </p>

            <!-- Reset Button -->
            <div class="button-container">
                <a href="{{ url('/reset-password/' . $token) }}" class="reset-button">
                    Reset Password Sekarang
                </a>
            </div>

            <!-- Warning -->
            <div class="warning">
                <p>
                    ⚠️ <strong>Penting:</strong> Link ini hanya berlaku selama <strong>1 jam</strong> dan hanya dapat digunakan satu kali.
                </p>
            </div>

            <!-- Alternative Link -->
            <div class="alternative-link">
                <p><strong>Jika tombol tidak berfungsi, salin dan tempel URL berikut ke browser:</strong></p>
                <a href="{{ url('/reset-password/' . $token) }}">{{ url('/reset-password/' . $token) }}</a>
            </div>

            <!-- Info -->
            <div class="info-box">
                <p>
                    ℹ️ Jika Anda tidak meminta reset password, abaikan email ini. Akun Anda tetap aman.
                </p>
            </div>

            <p style="margin-top: 30px; color: #777777; font-size: 14px;">
                Terima kasih,<br>
                <strong>Tim Layanan Aqiqah</strong>
            </p>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>Email ini dikirim otomatis, mohon tidak membalas.</p>
            <p>© {{ date('Y') }} Layanan Aqiqah. All rights reserved.</p>
            <p style="margin-top: 10px;">
                Butuh bantuan? Hubungi: <a href="mailto:{{ config('mail.from.address') }}" style="color: #667eea;">{{ config('mail.from.address') }}</a>
            </p>
        </div>
    </div>
</body>
</html>
