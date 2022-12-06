<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'book_name' => $this->faker->sentence(rand(2, 4)),
            'image' => 'https://source.unsplash.com/286x180/?book&' . rand(1, 1000),
            'page' => rand(100, 1000),
            'description' => $this->faker->text(170),
            'publisher' => $this->faker->company,
            'author' => $this->faker->firstName() . ' ' . $this->faker->lastName(),
            'stock' => rand(1, 100),
            'category_id' => rand(1, 28),
            'published_year' => $this->faker->date('Y-m-d', 'now'),
        ];
    }
}
