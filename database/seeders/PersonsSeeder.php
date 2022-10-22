<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PersonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('people')->insert([
            'user_id' => rand(61,1036),
            'date_of_birth' => now(),
            'place_of_birth' => 'Buea',
            'gender' => 'male',
            'nationality' => 'Cameroonian',
            'phone_number' => '677195500',
            'registration_date' => now(),
            'address' => 'P.O Box 215 - Sasse',
            'created_at' => now()
        ]);
    }
}
