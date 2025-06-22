<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Player;
use App\Models\Game;

class ChatTest extends TestCase
{
    use RefreshDatabase;

    public function test_chat_message_can_be_posted(): void
    {
        $player = Player::factory()->create();
        $game = Game::factory()->create(['host_id' => $player->player_id, 'name' => 'Chat Game']);
        $response = $this->withSession(['player_id' => $player->player_id])
            ->post('/chat/'.$game->game_id, ['message' => 'Hello']);
        $response->assertStatus(200);
        $this->assertDatabaseHas('chats', [
            'message' => 'Hello',
            'from_id' => $player->player_id,
            'game_id' => $game->game_id,
        ]);
    }
}
