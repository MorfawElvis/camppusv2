<?php

namespace Database\Factories;

use App\Models\Weekday;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeekdayFactory extends Factory
{
    protected $model = Weekday::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'short_name' => $this->faker->lexify('???'),
            'order' => $this->faker->numberBetween(1, 7),
        ];
    }
}
