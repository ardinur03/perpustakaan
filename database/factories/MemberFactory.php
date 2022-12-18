<?php

namespace Database\Factories;

use App\Models\User;
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
            // data member_code default nya adalah dosen, jika ingin mahasiswa maka hapus salah satustring concatnya
            'member_code' =>  $this->faker->unique()->randomNumber(9) . $this->faker->unique()->randomNumber(9),
            'gender' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'phone_number' => '+62' . $this->faker->unique()->randomNumber(8),
            'address' => $this->faker->address,
        ];
    }
}
