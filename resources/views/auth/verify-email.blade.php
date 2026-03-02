<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - LaraBook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .verify-card {
            background: white;
            border-radius: 20px;
            padding: 50px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="verify-card text-center">
                    <h1 class="mb-4">📧 Verify Your Email Address</h1>
                    
                    @if (session('success'))
                        <div class="alert alert-success">
                            ✅ {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        <p class="lead">Thanks for signing up with LaraBook!</p>
                        <p>Before getting started, please verify your email address by clicking on the link we just emailed to <strong>{{ Auth::user()->email }}</strong>.</p>
                        <p class="text-muted">If you didn't receive the email, click the button below.</p>
                    </div>

                    <form method="POST" action="{{ route('verification.send') }}" class="mb-3">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-lg">
                            📨 Resend Verification Email
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link text-muted">
                            ← Logout
                        </button>
                    </form>

                    <div class="mt-4 p-3 bg-light rounded">
                        <small class="text-muted">
                            <strong>Note:</strong> Check your spam folder if you don't see the email in your inbox.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>