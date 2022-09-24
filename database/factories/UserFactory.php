<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $types = ['administrator', 'singer', 'payer', 'freemium'];

        $typeSelected = fake()->randomElement($types);

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'nickname' => fake()->unique()->userName(),
            'last_login' => now(),
            'is_active' => fake()->boolean(),
            'email_verified_at' => now(),
            'type' => $typeSelected,
            'password' => 'password', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}