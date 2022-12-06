<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'member_name' => $this->faker->unique()->name,
            'user_id' => $this->faker->numberBetween(2, 20),
            'faculty_id' => $this->faker->numberBetween(1, 8),
            'member_code' => $this->faker->unique()->randomNumber(8),
            'gender' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'phone_number' => '+62' . $this->faker->unique()->randomNumber(8),
            'address' => $this->faker->address,
        ];
    }
}
