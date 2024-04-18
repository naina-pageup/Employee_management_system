<?php

namespace Database\Factories;

use Faker\Core\Number;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' =>fake()->name(),
            'email'=> fake()->unique()->safeEmail(),
            'address'=> fake()->name(),
            'salary'=> fake()->randomNumber(4),
            'contact'=>str::random(10),
            'manager_id'=> '3',
            'department_id'=> '1',
            'designation_id'=> '1',
            'joining_date'=>fake()->date(),
            'is_active'=> '1',
            'created_by'=> '1',
            'updated_by'=> '1',
        ];
    }
}
