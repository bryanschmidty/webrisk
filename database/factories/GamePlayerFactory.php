<?php

namespace Database\Factories;

use App\Models\GamePlayer;
use Illuminate\Database\Eloquent\Factories\Factory;

class GamePlayerFactory extends Factory
{
    protected $model = GamePlayer::class;

    public function definition(): array
    {
        return [
            'game_id' => 1,
            'player_id' => 1,
            'order_num' => 1,
            'color' => 'red',
            'state' => 'Waiting',
        ];
    }
}
