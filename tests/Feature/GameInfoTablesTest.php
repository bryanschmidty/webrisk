<?php

namespace Tests\Feature;

use App\Models\{Game, Player, GamePlayer};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameInfoTablesTest extends TestCase
{
    use RefreshDatabase;

    public function test_game_info_displays_tables(): void
    {
        $player = Player::factory()->create();
        $game = Game::factory()->create([
            'host_id' => $player->player_id,
            'extra_info' => json_encode([
                'trade_values' => [4,6,8],
                'trade_count' => 0,
                'conquer_type' => 'trade_value',
                'conquer_conquests_per' => 1,
                'conquer_per_number' => 10,
                'conquer_skip' => 0,
                'conquer_start_at' => 0,
                'conquer_minimum' => 1,
                'conquer_maximum' => 5,
            ]),
        ]);
        GamePlayer::create([
            'game_id' => $game->game_id,
            'player_id' => $player->player_id,
            'order_num' => 1,
            'color' => 'red',
            'state' => 'Waiting',
        ]);

        $html = game_info($game);
        $this->assertStringContainsString('custom_trades', $html);
        $this->assertStringContainsString('conquer_limits', $html);
    }
}
