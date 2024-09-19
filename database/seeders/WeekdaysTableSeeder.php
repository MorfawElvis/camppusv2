<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeekdaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $weekdays = [
            ['name' => 'Monday', 'short_name' => 'Mon', 'order' => 1],
            ['name' => 'Tuesday', 'short_name' => 'Tue', 'order' => 2],
            ['name' => 'Wednesday', 'short_name' => 'Wed', 'order' => 3],
            ['name' => 'Thursday', 'short_name' => 'Thu', 'order' => 4],
            ['name' => 'Friday', 'short_name' => 'Fri', 'order' => 5],
            ['name' => 'Saturday', 'short_name' => 'Sat', 'order' => 6],
            ['name' => 'Sunday', 'short_name' => 'Sun', 'order' => 7],
        ];

        DB::table('weekdays')->insert($weekdays);
    }
}
