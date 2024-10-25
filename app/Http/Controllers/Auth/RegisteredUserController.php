<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Otp;
use App\Mail\UserMail;
use Illuminate\Support\Facades\Mail;
use App\Otp\UserRegistrationOtp;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
     
      
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'img' => ['required|image'],
            'phone' => ['required','max:10','min:10'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required'],
        
          
        ]);
     
       
        $imgname=time().'.'.$request->file('image')->extension();
        $request->file('image')->move(public_path('images'), $imgname);
        
      
     $user = User::create([
        'name' =>$request->name,
        'img' =>$imgname,
        'cont-code' =>$request->country_code,
        'phone' =>$request->phone,
        'email' =>$request->email,
        'password' =>Hash::make($request->password),
        'role' =>$request->role,
       

     ]);


  
    //  event(new Registered($user));
    // Auth::login($user);
 
    $otp=rand(100000,999999);
    $carbon=Carbon::now();

    
  

   $mail=otp::create([
   'user_id'=>$user->id,
    'ver_email' => $request->email,
    'otp_code' => $otp,
    'status'=>'unverified',
    'otp_expire' => $carbon->addMinutes(10)
 ]);


 Mail::to($request->email)->send(new UserMail($otp));


     return redirect(route('otp.view'))->with('status', 'Otp Sent Successfully, Check Mail');
   
    }
}
