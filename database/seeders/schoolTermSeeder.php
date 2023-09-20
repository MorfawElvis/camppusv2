<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class schoolTermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('school_terms')->insert([
            'term_name' => 'First Term',
            'school_year_id' => '1',
            'term_status' => 'closed',
            'created_at' => now(),
        ]);
        DB::table('school_terms')->insert([
            'term_name' => 'Second Term',
            'school_year_id' => '1',
            'term_status' => 'closed',
            'created_at' => now(),
        ]);
        DB::table('school_terms')->insert([
            'term_name' => 'Third Term',
            'school_year_id' => '1',
            'term_status' => 'closed',
            'created_at' => now(),
        ]);
    }
}
