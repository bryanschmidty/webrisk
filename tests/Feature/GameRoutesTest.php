<?php

namespace Tests\Feature;

use App\Models\Player;
use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_games_index_returns_successful_response(): void
    {
        $host = Player::factory()->create();
        Game::factory()->create(['host_id' => $host->player_id, 'name' => 'Test Game']);
        $response = $this->get('/games');
        $response->assertStatus(200);
    }

    public function test_game_show_returns_successful_response(): void
    {
        $host = Player::factory()->create();
        $game = Game::factory()->create(['host_id' => $host->player_id, 'name' => 'Show Game']);
        $response = $this->get('/games/'.$game->game_id);
        $response->assertStatus(200);
    }
}
