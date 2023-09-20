<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'user_code' => (rand(100, 1000).Str::upper(Str::random(3))),
            'email' => 'admin@camppus.net',
            'password' => Hash::make('123456'), // password
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'role_id' => '1',
            'user_code' => 'superadmin',
            'email' => 'superadmin@camppus.net',
            'password' => Hash::make('Sabibi@2220'), // password
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'user_code' => (rand(100, 1000).Str::upper(Str::random(3))),
            'email' => 'teacher@camppus.net',
            'password' => Hash::make('123456'), // password
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'role_id' => '3',
            'user_code' => (rand(100, 1000).Str::upper(Str::random(3))),
            'email' => 'accountant@camppus.net',
            'password' => Hash::make('123456'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}
