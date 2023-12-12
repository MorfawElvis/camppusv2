<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         DB::table('users')->insert([
            'role_id' => '1',
            'user_code' => '482TME',
            'email' => 'admin@camppus.net',
            'password' => Hash::make('Burs2022'), // password
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'role_id' => '1',
            'user_code' => 'superadmin',
            'email' => 'superadmin@camppus.net',
            'password' => Hash::make('Sabibi@2220'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}
