<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(4, true),
            'content' => $this->faker->paragraphs(5),
            'upvotes' => $this->faker->numberBetween(0, 400),
            'downvotes' => $this->faker->numberBetween(0, 400),
        ];
    }
}
