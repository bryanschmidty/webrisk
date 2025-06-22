<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    protected $model = Game::class;

    public function definition(): array
    {
        return [
            'host_id' => 1,
            'name' => fake()->sentence(2),
            'capacity' => 2,
            'allow_kibitz' => false,
            'game_type' => 'Original',
            'next_bonus' => 4,
            'state' => 'Waiting',
            'paused' => false,
        ];
    }
}
