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
        $user_factory = UserFactory::new()->create();
        return [
            'member_name' => str_replace('.', ' ', $user_factory->username),
            'user_id' => $user_factory->id,
            'study_program_id' => $this->faker->numberBetween(1, 8),
            'member_code' => $this->faker->unique()->randomNumber(8),
            'gender' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'phone_number' => '+62' . $this->faker->unique()->randomNumber(8),
            'address' => $this->faker->address,
        ];
    }
}
