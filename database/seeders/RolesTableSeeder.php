<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role_name' => 'Admin',
            'role_slug' => 'admin',
        ]);

        DB::table('roles')->insert([
            'role_name' => 'Teacher',
            'role_slug' => 'teacher',
        ]);

        DB::table('roles')->insert([
            'role_name' => 'Accountant',
            'role_slug' => 'accountant',
        ]);

        DB::table('roles')->insert([
            'role_name' => 'Super Admin',
            'role_slug' => 'sup-admin',
        ]);

        DB::table('roles')->insert([
            'role_name' => 'Student',
            'role_slug' => 'stud',
        ]);
    }
}
