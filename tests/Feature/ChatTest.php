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

    public function test_fetch_returns_messages_for_game(): void
    {
        $player = Player::factory()->create();
        $game = Game::factory()->create(['host_id' => $player->player_id]);
        \App\Models\Chat::create([
            'message' => 'first',
            'from_id' => $player->player_id,
            'game_id' => $game->game_id,
            'private' => false,
        ]);
        \App\Models\Chat::create([
            'message' => 'other',
            'from_id' => $player->player_id,
            'game_id' => 0,
            'private' => false,
        ]);
        $response = $this->get('/chat/'.$game->game_id.'/messages');
        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $response->assertJsonFragment(['message' => 'first']);
    }


    public function test_post_requires_authentication(): void
    {
        $game = Game::factory()->create();
        $response = $this->post('/chat/'.$game->game_id, ['message' => 'Hi']);
        $response->assertStatus(401);
    }
}
