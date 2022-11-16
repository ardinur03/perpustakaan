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
            'page' => rand(100, 1000),
            'description' => $this->faker->text(170),
            'publisher' => $this->faker->company,
            'author' => $this->faker->name,
            'stock' => rand(1, 100),
            'category_id' => rand(1, 35),
            'published_year' => $this->faker->date('Y-m-d', 'now'),
        ];
    }
}
