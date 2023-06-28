<?php

namespace App\Http\Livewire\Auth;

use App\Http\Controllers\Traits\User_Auth_Trait;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\View\View;
use Livewire\Component;

class LoginForm extends Component
{
    use User_Auth_Trait;
    public $email;
    public $password;
    public function render() : View
    {
        return view('livewire.auth.login-form');
    }

    public function rules (): array
    {
        return $this->login_rules();
    }

    public function messages() : array
    {
        return $this->login_messages();
    }
    /**
     * @return Response
     */
    public function login () :mixed
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];
        // Authenticate the user
        if (!auth()->attempt($credentials)) {
            return  back()->with('error', 'Invalid Username or Password');
        }

        return redirect('/dashboard')->with('success', 'User logged in successfully');
    }
}
