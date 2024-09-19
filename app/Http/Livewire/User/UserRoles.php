<?php

namespace App\Http\Livewire\User;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserRoles extends Component
{
    use LivewireAlert;

    public $role_name;
    public $roles;

    protected $rules = [
        'role_name' => 'required|string|unique:roles,name',
    ];

    public function mount()
    {
        $this->roles = Role::all();
    }

    public function addRole()
    {
        $this->validate();

        $capitalizedRoleName = ucwords($this->role_name);

        Role::create(['name' => $capitalizedRoleName]);

        $this->role_name = '';
        $this->roles = Role::all();

        $this->alert('success', 'Role added successfully');
//        session()->flash('message', 'Role added successfully.');
    }

    public function render()
    {
        return view('livewire.user.user-roles');
    }
}
