<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Models\Otp;
use Illuminate\Support\Facades\Auth;

class newusermiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $otp = otp::where('status', 'unverified')->first();
      
        if(Auth::check() && $otp){
           

            return redirect()->route('otp.view');
          }
        return $next($request);
        
    }
}
