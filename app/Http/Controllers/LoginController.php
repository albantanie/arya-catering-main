<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function index()
    {
        return view('pages.login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            // Regenerate the session to prevent session fixation attacks
            $request->session()->regenerate();

            // Get the authenticated user
            $user = Auth::user();

            // Set a success flash message
            $request->session()->flash('login_success', 'Login successful! Welcome back.');

            // Redirect based on user role
            if ($user->role_id === 1) { // Assuming 1 is the role_id for admin
                return redirect()->route('admin.index');
            } else if ($user->role_id === 2) { // Assuming 2 is the role_id for user
                return redirect()->route('user.index');
            } else {
                // Handle unexpected roles
                return redirect('/')->withErrors([
                    'role' => 'Unexpected role assigned.',
                ]);
            }
        }

        // Authentication failed, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        // Log out the user
        Auth::logout();

        // Invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the home page with a logout success message
        return redirect('/')->with('logout_success', 'You have been logged out successfully.');
    }
}
