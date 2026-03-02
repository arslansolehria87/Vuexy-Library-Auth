<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial; background: #f4f4f4; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 50px auto; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 40px 20px; text-align: center; }
        .content { padding: 40px 30px; }
        .button { display: inline-block; padding: 15px 30px; background: #667eea; color: white; text-decoration: none; border-radius: 5px; margin-top: 20px; }
        .footer { background: #f8f9fa; padding: 20px; text-align: center; color: #6c757d; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 Welcome to LaraBook!</h1>
        </div>
        <div class="content">
            <h2>Hello {{ $user->name }}! 👋</h2>
            <p>Thank you for joining LaraBook!</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Joined:</strong> {{ $user->created_at->format('M d, Y') }}</p>
            <a href="{{ url('/login') }}" class="button">Login to Dashboard</a>
        </div>
        <div class="footer">
            <p>© 2026 LaraBook. Created by Arslan Solehria.</p>
        </div>
    </div>
</body>
</html>