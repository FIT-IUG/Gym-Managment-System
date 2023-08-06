<?php

namespace Database\Factories;

use App\Models\Gym;
use App\Models\Coach;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coach>
 */
class CoachFactory extends Factory
{
    protected $model = Coach::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $password = 123456789;

        $gender = $this->faker->randomElement(['male', 'female']);

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'gender' => $gender,
            'password' => Hash::make($password),
            'profile_image' => 'Client.Png',
            'description' => $this->faker->text(190),
        ];
    }
}
