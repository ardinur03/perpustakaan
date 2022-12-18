<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->firstName . ' ' . $this->faker->lastName;
        // cek username pada table users
        $cek_username = User::where('username', str_replace(' ', '.', $name))->first();
        // jika username sudah ada maka generate ulang
        if ($cek_username) {
            $name = $this->faker->firstName . ' ' . $this->faker->lastName . ' ' . $this->faker->lastName;
        }
        $email = strtolower(str_replace(' ', '.', $name));

        return [
            'username' => str_replace(' ', '.', $name),
            'email' => $email . '@polban.ac.id',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'), // 12345678
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
