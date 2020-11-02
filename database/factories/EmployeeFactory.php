<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'salary' => $this->faker->randomNumber(4),
            'bio' => implode(' ', $this->faker->sentences),
            'role_id' => Role::factory(),
        ];
    }
}
