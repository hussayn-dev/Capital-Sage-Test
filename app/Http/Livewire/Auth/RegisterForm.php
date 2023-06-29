<?php

namespace App\Http\Livewire\Auth;

use App\Http\Controllers\Traits\User_Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class RegisterForm extends Component
{
    use User_Auth;

    public string $email;

    public string $password;

    public string $name;

    public string $password_confirmation;

    public function render(): View
    {
        return view('livewire.auth.register-form');
    }

    public function rules(): array
    {
        return $this->register_rules();
    }

    public function messages(): array
    {
        return $this->register_messages();
    }

    public function register(): mixed
    {
        $this->validate();
        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
            'name' => $this->name,
        ];
        // Create the user
        $user = $this->create_user($credentials);

        Auth::login($user);

        return redirect('/dashboard')->with('success', 'User logged in successfully');
    }
}
