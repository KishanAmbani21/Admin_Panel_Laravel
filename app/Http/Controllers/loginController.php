<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function login_form(){
        return view('dashboard');
    }
    
    public function login(Request $request)
    {
        
        $request->validate([
            'email' => ['required','email', 'string'],
            'password' => ['required', 'min:5', 'string'],
        ]);
    
        
        $user = User::where('email', $request->email)->first();
    
        if ($user) {
            
            if (Auth::attempt($request->only('email', 'password'))) {
                
                return redirect('/dashboard'); 
            } else {
                
                // dd('Authentication failed');
                return back()->withErrors([
                    'password' => 'The provided password is incorrect.',
                ])->withInput(); 
                
            }

        } else {
            
            return back()->withErrors([
                'email' => 'The provided Email is not register.',
            ])->withInput();  
        }
    }

    public function logout(){

        Auth::logout();
        // $request->session()->forget('id');
        return redirect('/');
    }
}
