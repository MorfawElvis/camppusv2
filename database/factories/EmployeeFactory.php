<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'matriculation' => $this->faker->word(),
            'date_of_birth' => $this->faker->date(),
            'place_of_birth' => $this->faker->word(),
            'gender' => $this->faker->word(),
            'highest_qualification' => $this->faker->word(),
            'position' => $this->faker->word(),
            'nationality' => $this->faker->word(),
            'marital_status' => $this->faker->word(),
            'denomination' => $this->faker->word(),
            'date_of_employment' => $this->faker->date(),
            'basic_salary' => $this->faker->numberBetween('25000', '250000'),
            'insurance_number' => $this->faker->word(),
            'phone_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'is_dismissed' => $this->faker->boolean(),
            'is_retired' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'profile_image' => $this->faker->word(),

            'user_id' => User::factory(),
        ];
    }
}
