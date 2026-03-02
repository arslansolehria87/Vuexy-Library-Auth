@extends('layouts.auth_master') @section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="authentication-inner py-4" style="max-width: 450px; width: 100%;">
      <div class="card shadow-sm">
            <div class="card-body">
      <div class="app-brand justify-content-center mb-4 mt-2">
    <a href="{{ url('/') }}" class="app-brand-link gap-2 d-flex align-items-center" style="text-decoration: none;">
      <span class="app-brand-logo demo">
        <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z" fill="#7367F0" />
          <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
          <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
          <path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="#7367F0" />
        </svg>
      </span>
      <span class="app-brand-text demo text-body fw-bold ms-1" style="font-size: 1.5rem; color: #566a7f !important; text-transform: lowercase;">vuexy</span>
    </a>
  </div>
          <h4 class="mb-1 pt-2">Adventure starts here 🚀</h4>
          <p class="mb-4">Make your app management easy and fun!</p>

          <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="mb-3">
              <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="Enter your first name" autofocus required>
              @error('first_name') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            
            <div class="mb-3">
              <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Enter your last name" required>
              @error('last_name') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            
            <div class="mb-3">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" placeholder="Enter your address">
              @error('address') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            
            <div class="mb-3">
              <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
              @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            
            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required />
                <span class="input-group-text cursor-pointer"><i class="ti tabler-eye-off"></i></span>
              </div>
              @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            
            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
              <div class="input-group input-group-merge">
                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required />
                <span class="input-group-text cursor-pointer"><i class="ti tabler-eye-off"></i></span>
              </div>
            </div>

            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" required>
                <label class="form-check-label" for="terms-conditions">
                  I agree to privacy policy & terms
                </label>
              </div>
            </div>
            
            <button type="submit" class="btn btn-primary d-grid w-100">
              Sign up
            </button>
          </form>

          <p class="text-center">
            <span>Already have an account?</span>
            <a href="{{ route('login') }}" class="text-decoration-none">
              <span>Sign in instead</span>
            </a>
          </p>
          
        </div>
      </div>
      </div>
  </div>
</div>
@endsection