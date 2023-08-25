<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            "title"=> $this->faker->text(15),
            "subTitle"=> $this->faker->text(30),
            "description"=> $this->faker->text(190),
            "image"=> $this->faker->imageUrl()
        ];
    }
}
