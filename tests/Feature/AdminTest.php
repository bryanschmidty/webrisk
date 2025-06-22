<?php

namespace Tests\Feature;

use App\Models\Player;
use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_approve_player(): void
    {
        $admin = Player::factory()->create(['is_admin' => true]);
        $player = Player::factory()->create(['is_approved' => false]);

        $response = $this->withSession(['player_id' => $admin->player_id])
            ->post('/admin/players/'.$player->player_id.'/approve');

        $response->assertRedirect('/admin');
        $this->assertTrue($player->fresh()->is_approved);
    }

    public function test_admin_can_pause_and_unpause_game(): void
    {
        $admin = Player::factory()->create(['is_admin' => true]);
        $game = Game::factory()->create();

        $this->withSession(['player_id' => $admin->player_id])
            ->post('/admin/games/'.$game->game_id.'/pause')
            ->assertRedirect('/admin');

        $this->assertTrue($game->fresh()->paused);

        $this->withSession(['player_id' => $admin->player_id])
            ->post('/admin/games/'.$game->game_id.'/unpause')
            ->assertRedirect('/admin');

        $this->assertFalse($game->fresh()->paused);
    }
}
