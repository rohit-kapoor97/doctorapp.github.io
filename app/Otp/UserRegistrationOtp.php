<?php

namespace App\Otp;

use SadiqSalau\LaravelOtp\Contracts\OtpInterface as Otp;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRegistrationOtp implements Otp
{
    /**
     * Constructs Otp class
     * 
     * @param string $name
     *
     * @param string $email
     * @param string $password
     */
    public function __construct(
        protected  $name,
        protected $countrycode,
        protected  $phone,
        protected  $email,
        protected $password,
    )
    {
        
    }

    /**
     * Processes the Otp
     *
     * @return mixed
     */
    public function process()
    {
        $user = User::ungaruded(function () {
            return create([
              'name' => $this->name,
              'cont-code' => $this->countrycode,
              'phone' => $this->phone,
              'email' => $this->email,
              'password' => Hash::make($this->password),
              'email_verified_at' => now(),
             ]);

        });

        event(new Registered($user));
        Auth::login($user);
        return redirect()->route('index.view')->with('status', 'you login successfully');
    }
}
