<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial; background: #f4f4f4; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 50px auto; background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 8px 20px rgba(0,0,0,0.15); }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 50px 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 32px; }
        .content { padding: 40px 30px; }
        .otp-box { background: #f8f9fa; border: 3px dashed #667eea; padding: 30px; margin: 25px 0; text-align: center; border-radius: 10px; }
        .otp-code { font-size: 48px; font-weight: 800; color: #667eea; letter-spacing: 10px; font-family: 'Courier New', monospace; }
        .warning { background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 20px 0; border-radius: 5px; }
        .button { display: inline-block; padding: 15px 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 50px; margin-top: 20px; font-weight: 600; }
        .footer { background: #f8f9fa; padding: 30px; text-align: center; color: #6c757d; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔐 Reset Your Password</h1>
            <p>Password Reset Request</p>
        </div>

        <div class="content">
            <h2>Hello! 👋</h2>
            <p>We received a request to reset your password for your LaraBook account.</p>
            <p>Use the following <strong>One-Time Password (OTP)</strong> to reset your password:</p>

            <div class="otp-box">
                <p style="margin: 0 0 10px 0; color: #666; font-size: 14px;">Your OTP Code:</p>
                <div class="otp-code">{{ $otp }}</div>
                <p style="margin: 10px 0 0 0; color: #999; font-size: 12px;">Valid for 15 minutes</p>
            </div>

            <div class="warning">
                <strong>⚠️ Security Notice:</strong><br>
                • This OTP will expire in 15 minutes<br>
                • Do not share this code with anyone<br>
                • If you didn't request this, please ignore this email
            </div>

            <p style="text-align: center; margin: 30px 0;">
                <a href="{{ url('/reset-password?email=' . $email) }}" class="button">Reset Password Now</a>
            </p>

            <p style="margin-top: 30px; font-size: 14px; color: #999;">
                If the button doesn't work, copy and paste this link in your browser:<br>
                <a href="{{ url('/reset-password?email=' . $email) }}" style="color: #667eea;">{{ url('/reset-password?email=' . $email) }}</a>
            </p>
        </div>

        <div class="footer">
            <p><strong>LaraBook</strong> - Library Management System</p>
            <p>Created by <strong>Arslan Solehria</strong></p>
            <p>© {{ date('Y') }} LaraBook. All rights reserved.</p>
            <p style="margin-top: 15px; font-size: 12px;">
                This is an automated email. Please do not reply.
            </p>
        </div>
    </div>
</body>
</html>