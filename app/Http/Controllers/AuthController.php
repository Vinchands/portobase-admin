<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginView()
    {
      return view('guest.login');
    }
    
    public function login(Request $request): RedirectResponse
    {
      $credentials = $request->validate([
          'email' => 'required|email',
          'password' => 'required',
      ]);
      
      $remember = $request->filled('remember');
      
      if (Auth::attempt($credentials, $remember)) {
          $request->session()->regenerate();
          
          return redirect()->route('dashboard')->with('welcome', 'Welcome back!');
      }
      
      return back()->withErrors([
          'email' => 'Invalid credentials.',
      ])->onlyInput('email');
    }
    
    public function registerView()
    {
      return view('guest.register');
    }
    
    public function register(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'name' => 'required|min:3|max:50',
            'username' => 'required|alpha_dash|min:3|max:30|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ], [
          'email.unique' => 'Please try different email.'
        ]);
        
        $user = User::create([
            'name' => $credentials['name'],
            'username' => $credentials['username'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
        ]);
        
        Auth::login($user);
        
        return redirect()->route('dashboard')->with('welcome', 'Registration successful. Welcome!');
    }
    
    public function logout(Request $request): RedirectResponse
    {
      Auth::logout();
      
      $request->session()->invalidate();
      $request->session()->regenerateToken();
      
      return redirect()->route('login');
    }
}
