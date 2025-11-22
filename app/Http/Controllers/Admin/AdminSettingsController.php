<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminSettingsController extends Controller
{
    /**
     * Update General Settings
     */
    public function updateGeneral(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'admin_email' => 'required|email',
        ]);

        // Example: save to config or database
        // Here, you could use a settings table or env variables
        // For demonstration, we'll just flash a success message

        return back()->with('success', 'General settings updated successfully.');
    }

    /**
     * Update Password
     */
   public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:6|confirmed',
    ]);

    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    Auth::logout(); // log out the user after password change

    return redirect()->route('login')->with('success', 'Password updated successfully. Please log in again.');
}


    /**
     * Update System Controls
     */
    public function updateSystem(Request $request)
    {
        // Example: toggle maintenance mode and email notifications
        $maintenance = $request->has('maintenance_mode') ? true : false;
        $notifications = $request->has('email_notifications') ? true : false;

        // Save these values to a settings table or config as needed

        return back()->with('success', 'System settings updated successfully.');
    }
}
