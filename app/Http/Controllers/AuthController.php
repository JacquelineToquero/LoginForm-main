<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Constructor to apply middleware for authentication
    public function __construct()
    {
        // Apply 'guest' middleware to all methods except 'logout'
        $this->middleware('guest')->except('logout');
    }

    // Show the registration form
    public function register()
    {
        return view('auth/register');
    }

    // Handle the registration form submission
    public function registerSave(Request $request)
    {
        // Validate the registration request
        Validator::make($request->all(), [
            'name' => 'required', // Name is required
            'email' => 'required|email', // Email is required and must be valid
            'password' => 'required|confirmed' // Password is required and must match the confirmation
        ])->validate();

        // Create a new user in the database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password before saving
            'type' => "0" // Default user type
        ]);

        // Redirect to the login page after registration
        return redirect()->route('login');
    }

    // Show the login form
    public function login()
    {
        return view('auth/login');
    }

    // Handle the login form submission
    public function loginAction(Request $request)
    {
        // Validate the login request
        Validator::make($request->all(), [
            'email' => 'required|email', // Email is required and must be valid
            'password' => 'required' // Password is required
        ])->validate();

        // Attempt to log the user in
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            // Throw validation exception if login fails
            throw ValidationException::withMessages([
                'email' => trans('auth.failed') // Return the authentication failure message
            ]);
        }

        // Regenerate the session to prevent session fixation
        $request->session()->regenerate();

        // Redirect based on user type after successful login
        if (auth()->user()->type == 'admin') {
            return redirect()->route('admin.home'); // Redirect admin users to the admin home
        } else {
            return redirect()->route('home'); // Redirect regular users to the home page
        }

        // Fallback redirect (this line is unreachable)
        return redirect()->route('dashboard');
    }

    // Handle user logout
    public function logout(Request $request)
    {
        // Log the user out
        Auth::guard('web')->logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Redirect to the login page after logout
        return redirect('/login');
    }

    // Show the user profile
    public function profile()
    {
        return view('userprofile');
    }
}
