<?php

namespace App\Http\Livewire\Auth;

use App\Models\SchoolYear;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserLogin extends Component
{
    public $form = [
        'user_code'   => '',
        'password'=> '',
    ];
    public function login()
    {
        $this->validate([
            'form.user_code'    => 'required|exists:users,user_code,user_status,' . User::ACTIVE,
            'form.password' => 'required',
        ]);
        Auth::attempt($this->form);
        return redirect(route('dashboard'));
    }
    public function updated()
    {
        $this->validate(
            [
                'form.user_code'    => 'required|exists:users,user_code,user_status,' . User::ACTIVE,
                'form.password' => 'required',
            ]
        );
    }
    public function render()
    {

        return view('livewire.auth.user-login');
    }
}
