<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'support']);
        $user = \App\Models\User::factory()->create([
            'role_id' => '9',
            'user_code' => 'elvis1983',
            'email' => 'support@test.com',
            'password' => Hash::make('123456'), // password
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole($role1);
//        $this->call(RolesTableSeeder::class);
//        $this->call(UsersTableSeeder::class);
//        $this->call(schoolYearSeeder::class);
//        $this->call(schoolTermSeeder::class);
    }
}
