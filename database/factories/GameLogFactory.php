<?php

namespace Database\Factories;

use App\Models\GameLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameLogFactory extends Factory
{
    protected $model = GameLog::class;

    public function definition(): array
    {
        return [
            'game_id' => 1,
            'data' => $this->faker->sentence(),
            'create_date' => now(),
            'microsecond' => 0,
        ];
    }
}
