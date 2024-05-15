<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function loginForm()
    {
        return view('dashboard');
    }

    /**
     * Handle user login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if ($user && Hash::check($request->password, $user->password)) {
                $request->session()->put('loginId', $user->id);
                return redirect()->route('dashboard');
            } else {
                return back()->withErrors([
                    'password' => 'The provided password is incorrect.',
                ])->withInput();
            }
        } else {
            return back()->withErrors([
                'email' => 'The provided email is not registered.',
            ])->withInput();
        }
    }

    /**
     * Log the user out.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        $request->session()->forget('loginId');
        return redirect('/')->with('success', 'Logged out successfully');
    }
}
