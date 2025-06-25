<?php

namespace Tests\Feature;

use App\Models\{Game, GamePlayer, Player};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FogOfWarCardsTest extends TestCase
{
    use RefreshDatabase;

    public function test_card_count_visible_without_fog(): void
    {
        $host = Player::factory()->create();
        $player = Player::factory()->create();
        $extra = [
            'fog_of_war_armies' => 'all',
            'fog_of_war_colors' => 'all',
            'fog_of_war_cards' => 'all'
        ];
        $game = Game::factory()->create([
            'host_id' => $host->player_id,
            'extra_info' => json_encode($extra)
        ]);
        GamePlayer::create([
            'game_id' => $game->game_id,
            'player_id' => $host->player_id,
            'order_num' => 1,
            'color' => 'red',
            'state' => 'Attacking',
            'cards' => 'i1 i2'
        ]);
        GamePlayer::create([
            'game_id' => $game->game_id,
            'player_id' => $player->player_id,
            'order_num' => 2,
            'color' => 'blue',
            'state' => 'Attacking',
            'cards' => 'i3 i4'
        ]);
        $response = $this->withSession(['player_id' => $host->player_id])
            ->get('/games/' . $game->game_id);
        $response->assertSee('<span class="cards">2</span>', false);
    }

    public function test_card_count_hidden_with_fog(): void
    {
        $host = Player::factory()->create();
        $player = Player::factory()->create();
        $extra = [
            'fog_of_war_armies' => 'all',
            'fog_of_war_colors' => 'all',
            'fog_of_war_cards' => 'self'
        ];
        $game = Game::factory()->create([
            'host_id' => $host->player_id,
            'extra_info' => json_encode($extra)
        ]);
        GamePlayer::create([
            'game_id' => $game->game_id,
            'player_id' => $host->player_id,
            'order_num' => 1,
            'color' => 'red',
            'state' => 'Attacking',
            'cards' => 'i1 i2'
        ]);
        GamePlayer::create([
            'game_id' => $game->game_id,
            'player_id' => $player->player_id,
            'order_num' => 2,
            'color' => 'blue',
            'state' => 'Attacking',
            'cards' => 'i3 i4'
        ]);
        $response = $this->withSession(['player_id' => $host->player_id])
            ->get('/games/' . $game->game_id);
        $response->assertSee('<span class="cards">?</span>', false);
    }
}
