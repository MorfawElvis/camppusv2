<?php

namespace Database\Factories;

use App\Models\People;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeopleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = People::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(75,1036),
            'date_of_birth' => now(),
            'place_of_birth' => 'Buea',
            'gender' => 'male',
            'nationality' => 'Cameroonian',
            'phone_number' => '677195500',
            'registration_date' => now(),
            'address' => 'P.O Box 215 - Sasse',
            'created_at' => now()
        ];
    }
}
