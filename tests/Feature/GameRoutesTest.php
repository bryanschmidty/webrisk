<?php

namespace Tests\Feature;

use App\Models\Player;
use App\Models\Game;
use App\Models\GamePlayer;
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

    public function test_create_form_displays(): void
    {
        $response = $this->get('/games/create');
        $response->assertStatus(200);
    }

    public function test_player_can_create_game(): void
    {
        $player = Player::factory()->create();
        $this->withSession(['player_id' => $player->player_id]);
        $response = $this->post('/games', [
            'name' => 'New Game',
            'capacity' => 2,
            'fortify' => true,
            'fog_of_war_armies' => 'all',
            'fog_of_war_colors' => 'all',
            'initial_army_limit' => 0,
        ]);
        $game = Game::first();
        $response->assertRedirect('/games/'.$game->game_id);
        $this->assertDatabaseHas('games', ['name' => 'New Game']);
        $this->assertDatabaseHas('game_players', ['game_id' => $game->game_id, 'player_id' => $player->player_id]);
    }

    public function test_join_form_displays(): void
    {
        $host = Player::factory()->create();
        $game = Game::factory()->create(['host_id' => $host->player_id]);
        GamePlayer::create(['game_id' => $game->game_id, 'player_id' => $host->player_id, 'order_num' => 1, 'color' => 'red', 'state' => 'Waiting']);
        $response = $this->get('/games/'.$game->game_id.'/join');
        $response->assertStatus(200);
    }

    public function test_player_can_join_game(): void
    {
        $host = Player::factory()->create();
        $game = Game::factory()->create(['host_id' => $host->player_id]);
        GamePlayer::create(['game_id' => $game->game_id, 'player_id' => $host->player_id, 'order_num' => 1, 'color' => 'red', 'state' => 'Waiting']);
        $player = Player::factory()->create();
        $this->withSession(['player_id' => $player->player_id]);
        $response = $this->post('/games/'.$game->game_id.'/join', [
            'color' => 'blue',
        ]);
        $response->assertRedirect('/games/'.$game->game_id);
        $this->assertDatabaseHas('game_players', ['game_id' => $game->game_id, 'player_id' => $player->player_id]);
    }
}
