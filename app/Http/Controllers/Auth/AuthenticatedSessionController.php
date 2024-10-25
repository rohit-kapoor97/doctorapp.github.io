<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Mail\UserMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Otp;
use Carbon\Carbon;

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

        $request->session()->regenerate();

        $otp=rand(100000, 999999);
        $carbon=Carbon::now();
       
        $otpData = [
            'user_id' => Auth()->id(),
            'otp_code' => $otp,
            'otp_expire' => $carbon->addMinutes(10),
            'status'=>'unverified',
        ];

        $new = otp::updateOrCreate(
            ['ver_email' => $request->email],
            $otpData
        );

        Mail::to($request->email)->Send(new UserMail($otp));
   

       
        return redirect()->route('otp.view')->with('status', 'Otp Sent Successfully, Check Mail');

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
