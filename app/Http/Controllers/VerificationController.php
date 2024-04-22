<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
class VerificationController extends Controller
{
    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|numeric',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || $user->two_factor_secret != $request->code) {
            throw ValidationException::withMessages([
                'code' => 'The provided code is incorrect.',
            ]);
        }
        $user->two_factor_confirmed_at = Carbon::now();
        $user->two_factor_secret =null;
        $user->save();
        return redirect()->route('dashboard');
    }
}
