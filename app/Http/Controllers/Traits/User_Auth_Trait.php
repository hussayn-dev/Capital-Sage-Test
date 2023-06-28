<?php

namespace App\Http\Controllers\Traits;


use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Twilio\Rest\Client;

trait User_Auth_Trait
{

    public function register_rules () : array {
      return  [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
    public  function  register_messages () : array {
       return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Invalid email address.',
            'email.unique' => 'The email address is already registered.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];
    }
    public function login_rules () : array {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }
    public function login_messages () :array {
        return [
            'email.required' => 'The email field is required.',
            'email.email' => 'Invalid email address.',
            'password.required' => 'The password field is required.',
        ] ;
    }
    public function create_user ($validatedData) {

      $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);
      $user->save();
      return $user;
    }
}




