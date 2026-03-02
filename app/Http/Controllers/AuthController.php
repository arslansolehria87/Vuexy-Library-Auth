<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\projects;
use App\Models\User;
use App\Mail\WelcomeEmail;
use App\Mail\ResetPasswordEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// 1. Yeh line add ki hai (Email event ke liye) 👇
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // 1. Backend Validation
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|min:8|confirmed',
        ]);

        try {
            // 2. User Create Karein
            $user = User::create([
                'name'       => $request->first_name . ' ' . $request->last_name, 
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'address'    => $request->address,
                'password'   => Hash::make($request->password),
            ]);

            // 3. YEH LINE ADD KI HAI (Email bhejne ke liye) 👇
            event(new Registered($user));

            // 4. Fauran Login Karwayen
            Auth::login($user);

            // 5. Dashboard par bhejein Success Message ke sath
            return redirect()->route('dashboard')->with('success', 'Welcome to LaraBook!');

        } catch (\Exception $e) {
            // 🛑 JHOOTA ERROR HATA KAR ASLI ERROR SCREEN PAR DIKHAYEN:
            dd($e->getMessage()); 
        }
    }
    
    // ===== BAQI SARA CODE SAME HAI =====
    
    // ===== LOGIN =====
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    
    // ===== LOGOUT =====
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

   // ===== SEND OTP (FORGOT PASSWORD) =====
    public function sendOtp(Request $request)
    {
        // Validate email
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'This email is not registered with us.'
        ]);

        // Generate 6-digit OTP
        $otp = rand(100000, 999999);

        // Save OTP in password_resets table
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => $otp,
                'created_at' => now()
            ]
        );

        // 👇 YAHAN SE HUM NE MAILABLE CLASS KO BYPASS KAR DIYA 👇
        try {
            // Direct Mail::send use kar rahay hain baghair kisi class ke
            \Illuminate\Support\Facades\Mail::send('emails.reset-password', ['otp' => $otp, 'email' => $request->email], function($message) use ($request) {
                $message->to($request->email)
                        ->subject('Reset Your Password - LaraBook 🔐');
            });
        } catch (\Exception $e) {
            // Agar phir bhi error aya toh ab line number ke sath aayega
            dd("Direct Mail Error: " . $e->getMessage()); 
        }

        // Redirect to reset password page with email
        return redirect()->route('password.verify.form', ['email' => $request->email])
            ->with('success', 'OTP has been sent to your email! Check your inbox.');
    }

    // ===== RESET PASSWORD =====
    public function resetPassword(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required|string|size:6',
            'password' => 'required|string|min:8|confirmed'
        ]);

        // Check if OTP exists and is valid (within 15 minutes)
        $resetRecord = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->where('created_at', '>=', now()->subMinutes(15))
            ->first();

        if (!$resetRecord) {
            return back()->withErrors([
                'token' => 'Invalid or expired OTP. Please request a new one.'
            ]);
        }

        // Update user password
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        // Delete used OTP
        DB::table('password_resets')
            ->where('email', $request->email)
            ->delete();

        // Redirect to login with success message
        return redirect()->route('login')
            ->with('success', 'Password reset successful! Please login with your new password.');
    }
    // Team Save Karne Ka Function
    public function storeTeam(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Team::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Team created successfully!');
    }

    // Project Save Karne Ka Function
    public function storeProject(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'deadline' => 'nullable|date',
        ]);

        Project::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'deadline' => $request->deadline,
        ]);

        return back()->with('success', 'Project added successfully!');
    }
}