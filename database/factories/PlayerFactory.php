<?php

namespace Database\Factories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PlayerFactory extends Factory
{
    protected $model = Player::class;

    public function definition(): array
    {
        return [
            'username' => fake()->unique()->userName(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'timezone' => 'UTC',
            'is_admin' => false,
            'password' => md5('password'),
            'alt_pass' => md5('password'),
            'ident' => Str::random(32),
            'token' => Str::random(32),
            'is_approved' => true,
        ];
    }
}
