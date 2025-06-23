<?php

namespace Tests\Unit;

use App\Models\{Game, GamePlayer, Player};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameDrawPlayersTest extends TestCase
{
    use RefreshDatabase;

    public function test_draw_players_outputs_player_list(): void
    {
        $host = Player::factory()->create();
        $player = Player::factory()->create();
        $game = Game::factory()->create(['host_id' => $host->player_id]);
        GamePlayer::create(['game_id' => $game->game_id, 'player_id' => $host->player_id, 'order_num' => 1, 'color' => 'red', 'state' => 'Waiting']);
        GamePlayer::create(['game_id' => $game->game_id, 'player_id' => $player->player_id, 'order_num' => 2, 'color' => 'blue', 'state' => 'Waiting']);
        session(['player_id' => $player->player_id]);
        $html = $game->draw_players();
        $this->assertStringContainsString('id="p_'.$host->player_id.'"', $html);
        $this->assertStringContainsString('class="red host waiting', $html);
        $this->assertStringContainsString('class="blu me waiting', $html);
    }
}
