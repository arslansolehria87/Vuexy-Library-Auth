@extends('layouts.auth_master')

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="authentication-inner py-4" style="max-width: 450px; width: 100%;">
      
      <div class="card">
        <div class="card-body">
          <div class="app-brand justify-content-center mb-4 mt-2">
            <a href="{{ url('/') }}" class="app-brand-link gap-2 text-decoration-none">
              <span class="app-brand-text demo text-body fw-bold ms-1 fs-3">
                <i class="ti tabler-brand-vuejs text-primary"></i> Vuexy
              </span>
            </a>
          </div>
          <h4 class="mb-1 pt-2">Reset Password 🔒</h4>
          <p class="mb-4">Your new password must be different from previously used passwords</p>

          <form id="formAuthentication" class="mb-3" action="{{ route('password.update') }}" method="POST">
            @csrf

            {{-- ✅ FIX 1: Sirf hidden fields, visible email hata diya --}}
            <input type="hidden" name="email" value="{{ request()->input('email') }}">
            
            {{-- ✅ FIX 2: Token field add kiya --}}
            <input type="hidden" name="token" value="{{ request()->input('token') }}">

            {{-- OTP Input - User khud bhare ga --}}
            <div class="mb-3">
              <label for="token_display" class="form-label">Enter OTP</label>
              <input type="text" class="form-control @error('token') is-invalid @enderror" 
                     id="token_display" name="token" 
                     placeholder="6-digit OTP" maxlength="6" required>
              @error('token') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            
            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password">New Password</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       name="password" 
                       placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" 
                       required autofocus />
                <span class="input-group-text cursor-pointer"><i class="ti tabler-eye-off"></i></span>
              </div>
              @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password_confirmation">Confirm Password</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password_confirmation" 
                       class="form-control" 
                       name="password_confirmation" 
                       placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" 
                       required />
                <span class="input-group-text cursor-pointer"><i class="ti tabler-eye-off"></i></span>
              </div>
            </div>
            
            <button class="btn btn-primary d-grid w-100 mb-3">Set New Password</button>
          </form>

          <div class="text-center">
            <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center text-decoration-none">
              <i class="ti tabler-chevron-left scaleX-n1-rtl"></i>
              Back to login
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection