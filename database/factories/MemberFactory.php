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
            'member_name' => $this->faker->unique()->userName,
            'user_id' => null,
            // random id faculty
            'faculty_id' => null,
            'member_code' => null,
            'gender' => null,
            'phone_number' => null,
            'address' => null,
        ];
    }
}
