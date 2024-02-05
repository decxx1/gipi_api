<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserInfo>
 */
class UserInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 100),
            'role_id' => fake()->numberBetween(1, 4),
            'avatar' => fake()->imageUrl(),
            'title' => fake()->jobTitle(),
            'telphone' => fake()->phoneNumber(),
            'noti_email' => fake()->boolean(),
            'mode_dark' => fake()->boolean(),
            'is_online' => fake()->boolean(),
            'time_online' => fake()->dateTime(),
        ];
    }
}
