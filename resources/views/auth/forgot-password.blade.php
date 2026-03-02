@extends('layouts.auth_master')

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y d-flex justify-content-center align-items-center vh-100">
    <div class="authentication-inner py-4" style="max-width: 400px; width: 100%;">
        
        <div class="card shadow-sm">
            <div class="card-body">
                
                <div class="app-brand justify-content-center mb-4">
                    <span class="app-brand-text demo text-body fw-bold fs-3">Vuexy</span>
                </div>

                <h4 class="mb-2">Forgot Password? 🔒</h4>
                <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>

                @if (session('status'))
                    <div class="alert alert-success mb-3" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form id="formAuthentication" class="mb-3" action="{{ route('password.email') }}" method="POST">
                    @csrf 
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
                        
                        @error('email')
                            <span class="text-danger small mt-1 d-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary d-grid w-100">Send Reset Link</button>
                </form>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center text-decoration-none">
                        <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                        Back to login
                    </a>
                </div>

            </div>
        </div>
        
    </div>
  </div>
</div>
@endsection