@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        
        <div class="card mb-4">
            <h5 class="card-header">Account Details</h5>
            
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
            
                    
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="firstName" name="first_name" value="{{ auth()->user()->first_name ?? '' }}" autofocus required />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="last_name" id="lastName" value="{{ auth()->user()->last_name ?? '' }}" required />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail <span class="text-danger">*</span></label>
                            <input class="form-control" type="email" id="email" name="email" value="{{ auth()->user()->email ?? '' }}" required />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Phone Number</label>
                            <input type="text" id="phoneNumber" name="phone" class="form-control" placeholder="e.g. 202 555 0111" value="{{ auth()->user()->phone ?? '' }}" />
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="e.g. Sargodha, Punjab" value="{{ auth()->user()->address ?? '' }}" />
                        </div>
                    </div>
                    
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                        <button type="reset" class="btn btn-label-secondary">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <h5 class="card-header">Change Password</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                
                    
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="currentPassword" class="form-label">Current Password <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" name="current_password" id="currentPassword" required />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="newPassword" class="form-label">New Password <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" id="newPassword" name="password" minlength="8" required />
                            <small class="text-muted">Min. 8 characters</small>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="confirmPassword" class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" name="password_confirmation" id="confirmPassword" required />
                        </div>
                    </div>
                    
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Update password</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Success Alert 
        @if(session('status') === 'profile-updated' || session('status') === 'password-updated' || session('success'))
            Swal.fire({
                title: 'Success!',
                text: 'Updated successfully!',
                icon: 'success',
                confirmButtonColor: '#7367f0',
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        // Error Alerts
        @if($errors->any())
            Swal.fire({
                title: 'Error!',
                text: "{{ $errors->first() }}",
                icon: 'error',
                confirmButtonColor: '#ea5455'
            });
        @endif
    });
</script>
@endsection