<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => $this->faker->numberBetween(1, 3),
            'first_name' => $this->faker->lastName,
            'last_name' => $this->faker->firstName,
            'gender' => $this->faker->randomElement([1, 2]),
            'email' => $this->faker->unique()->safeEmail,
            'tel' => $this->faker->numerify('090-####-####'),
            'address' => $this->faker->address,
            'building' => $this->faker->secondaryAddress,
            'detail' => $this->faker->realText(25),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
