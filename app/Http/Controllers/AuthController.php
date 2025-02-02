<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Display the authentication form
    public function index() {
        return view('auth.index');
    }

    public function create(Request $request) {
        // Validate the input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user
        User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
        ]);

        // Redirect to the catalog route after successful registration
        return redirect('/catalog')->with('success', 'Registration successful!');
    }


     // Show the login form
     public function showLoginForm()
     {
         return view('auth.login'); // Return the login view
     }
 
     // Handle login request
     public function login(Request $request)
     {
         // Validate input
         $request->validate([
             'email' => 'required|email',
             'password' => 'required|string|min:8',
         ]);
 
         // Attempt to find the user by email
         $user = User::where('email', $request->email)->first();
 
         // Attempt to log in the user
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate(); // Prevent session fixation attacks

            // Redirect to profile or intended page
            return redirect()->intended('/profile')->with('success', 'Login successful!');
        }
 
         // If login fails, redirect back with error message
         return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
     }
 
     // Handle logout request
        public function logout()
        {
            session()->forget('user_name'); // Remove user name from session
            return redirect('/login')->with('success', 'Logged out successfully.');
        }
}
