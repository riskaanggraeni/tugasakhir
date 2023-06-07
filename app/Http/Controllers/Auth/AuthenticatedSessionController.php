<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        // $request->authenticate();
        // dd("login");

        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        
        if (Auth::guard('web')->attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            if(Auth::guard('web')->user()->roles == 'ADMIN'){
                return redirect()->route('admin-home');
            }else if(Auth::guard('web')->user()->roles == 'PENJUAL'){
                return redirect()->route('dashboard');
            }else {
                // dd('masuk jadi pembeli');
                return redirect()->intended(RouteServiceProvider::HOME);
                // return redirect('/');
            }
           
        }else{
            return redirect()->back()->withErrorMessage("Gagal Login");
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if (Auth::guard('web')->check()) {
            if(Auth::guard('web')->user()->roles == 'PENJUAL'){
                Auth::guard('web')->logout();
                return redirect('/login');
            }
            Auth::guard('web')->logout();

        } elseif (Auth::guard('penjual')->check()) {
            Auth::guard('penjual')->logout();
        } elseif (Auth::guard('pembeli')->check()) {
            Auth::guard('pembeli')->logout();
        } 

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
