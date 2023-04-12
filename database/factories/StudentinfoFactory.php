<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Studentinfo>
 */
class StudentinfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => $this->faker->firstName(),
            'middlename' => $this->faker->lastName(),
            'lastname' => $this->faker->lastName(),
            'birthdate' => $this->faker->date('Y-m-d'),
            'sex' => $this->faker->numberBetween(0, 1),
            'elem_school' => $this->faker->text('30'),
            'elem_school_id' => $this->faker->numberBetween(100000, 999999),
            'elem_school_citation' => 'N/A',
            'elem_school_address' => 'N/A',
            'gen_ave' => $this->faker->numberBetween(75, 99),
            'lrn' => $this->faker->numberBetween(100000000000, 999999999999)
        ];
    }
}
