<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        // return redirect()->intended(RouteServiceProvider::HOME);
        return $this->handleRedirectToHome();
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Redirect::route('login');
    }

    /**
     * Handle redirect to home
     *
     * @return \Illuminate\View\View
     */
    public function handleRedirectToHome()
    {
        if(auth()->user()->can('view reports')){
            return redirect()->route('reports.total-bets','total-bets');
        }

        if(auth()->user()->can('manage users')){
            return redirect()->route('users.index');
        }

        if(auth()->check()){
            // go to profile
        }
        abort(403);

    }
}
