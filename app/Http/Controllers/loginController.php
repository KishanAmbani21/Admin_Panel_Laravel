<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class LoginController
 *
 * Controller for managing user authentication.
 */
class LoginController extends Controller
{
    /**
     * Show the dashboard.
     *
     * @return dashboard blade file
     */
    public function dashboard()
    {
        return view('dashboard');
    }

    /**
     * login Validation.
     *
     * @param  $request The HTTP request instance
     * @return Redirect response after login attempt
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        $user = User::where('email', $credentials['email'])->first();
    
        if (!$user) {
            return back()->withErrors([
                'email' => 'Email is not registered',
            ])->withInput();
        }
    
        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'password' => 'Password is incorrect',
            ])->withInput();
        }
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
    
    }

    /**
     * Logout Validation.
     *
     * @param  $request The HTTP request instance
     * @return Redirect response after logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logged out successfully');
    }
}
