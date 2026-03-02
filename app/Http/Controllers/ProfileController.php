<?php

namespace App\Http\Controllers;
use App\Models\Team;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordUpdatedEmail;

class ProfileController extends Controller
{
    /**
     * Show profile page
     */
   public function edit()
{
    return view('profile.edit');
}
/**
     * Show My Profile Page
     */
    public function show()
    {
        return view('profile.show');
    }
    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        // Validate
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Check if current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Current password is incorrect.'
            ]);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        

        // Send confirmation email
        try {
            Mail::to($user->email)->send(new PasswordUpdatedEmail($user));
        } catch (\Exception $e) {
            // Continue even if email fails
        }
       

        return back()->with('success', 'Password updated successfully!');
    }
    /**
     * Update Profile Information
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
    

        // Validate data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        // Update User data
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // Wapas usi page par success message ke sath bhej dein
        return back()->with('success', 'Profile updated successfully!');
    }
    // ==========================================
    // 1. Team Save Karne Ka Function
    // ==========================================
    public function storeTeam(Request $request)
    {
        // Data check karein
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Database mein save karein
        Team::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Wapas usi page par bhej dein success message ke sath
        return back()->with('success', 'Team created successfully!');
    }

    // ==========================================
    // 2. Project Save Karne Ka Function
    // ==========================================
    public function storeProject(Request $request)
    {
        // Data check karein
        $request->validate([
            'title' => 'required|string|max:255',
            'deadline' => 'nullable|date',
        ]);

        // Database mein save karein
        Project::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'deadline' => $request->deadline,
        ]);

        // Wapas usi page par bhej dein success message ke sath
        return back()->with('success', 'Project added successfully!');
    }
}