<?php

namespace Tests\Unit;

use App\Helpers\BoardHelper;
use App\Models\{Game, GameLand, GamePlayer, Player};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BoardRenderTest extends TestCase
{
    use RefreshDatabase;

    public function test_render_returns_board_html(): void
    {
        $game = Game::factory()->create();
        $p1 = Player::factory()->create();
        $p2 = Player::factory()->create();
        GamePlayer::create(['game_id' => $game->game_id, 'player_id' => $p1->player_id, 'order_num' => 1, 'color' => 'red', 'state' => 'Attacking']);
        GamePlayer::create(['game_id' => $game->game_id, 'player_id' => $p2->player_id, 'order_num' => 2, 'color' => 'blue', 'state' => 'Resigned']);
        GameLand::create(['game_id' => $game->game_id, 'land_id' => 1, 'player_id' => $p1->player_id, 'armies' => 3]);
        GameLand::create(['game_id' => $game->game_id, 'land_id' => 2, 'player_id' => $p2->player_id, 'armies' => 2]);
        $html = BoardHelper::render($game);
        $this->assertStringContainsString('<span class="red" id="sl01"', $html);
        $this->assertStringContainsString('>3</span>', $html);
        $this->assertStringContainsString('<span class="blu res" id="sl02"', $html);
        $this->assertEquals(42, substr_count($html, '<span'));
    }
}
