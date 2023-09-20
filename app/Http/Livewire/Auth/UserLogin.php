<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserLogin extends Component
{
    public $form = [
        'user_code' => '',
        'password' => '',
    ];

    public function login()
    {
        $this->validate([
            'form.user_code' => 'required|exists:users,user_code,user_status,'.User::ACTIVE,
            'form.password' => 'required',
        ]);
        Auth::attempt($this->form);

        return redirect(route('dashboard'));
    }

    public function render()
    {

        return view('livewire.auth.user-login');
    }
}
