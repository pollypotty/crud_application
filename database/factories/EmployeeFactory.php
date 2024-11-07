<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        // obtain a real company instance to use it's id when creating the employee
        $company = Company::query()->inRandomOrder()->first() ?: Company::factory()->create();

        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'company_id' => $company->id,
            'email' => $this->faker->email(),
            'phone_number' => $this->faker->phoneNumber(),
        ];
    }
}
