<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Notifications\TwoFactorCodeNotification;
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
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $this->generateTwoFactorCode(Auth::user());
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::TWOSTEPAUTH);
    }

    public function generateTwoFactorCode($user)
    {
        $user = User::find($user->id);
        $user->two_factor_secret = rand(100000, 999999);
        // $user->two_factor_expires_at = now()->addMinutes(10);
        $user->save();
        $user->notify(new TwoFactorCodeNotification($user->two_factor_secret));
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
