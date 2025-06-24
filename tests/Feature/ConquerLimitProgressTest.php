<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\GamePlayer;
use App\Models\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConquerLimitProgressTest extends TestCase
{
    use RefreshDatabase;

    public function test_progress_indicator_displays()
    {
        $host = Player::factory()->create();
        $extra = ['conquer_limit' => 3];
        $game = Game::factory()->create([
            'host_id' => $host->player_id,
            'extra_info' => $extra,
        ]);
        GamePlayer::create([
            'game_id' => $game->game_id,
            'player_id' => $host->player_id,
            'order_num' => 1,
            'color' => 'red',
            'state' => 'Waiting',
            'extra_info' => ['conquered' => 1],
        ]);
        $p2 = Player::factory()->create();
        GamePlayer::create([
            'game_id' => $game->game_id,
            'player_id' => $p2->player_id,
            'order_num' => 2,
            'color' => 'blue',
            'state' => 'Waiting',
            'extra_info' => ['conquered' => 2],
        ]);

        $response = $this->get('/games/' . $game->game_id);
        $response->assertStatus(200);
        $response->assertSee('1 / 3', false);
        $response->assertSee('2 / 3', false);
    }
}
