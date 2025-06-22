<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\MessageGlue;
use App\Models\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    public function test_inbox_displays_messages(): void
    {
        $recipient = Player::factory()->create();
        $sender = Player::factory()->create();

        $message = Message::create([
            'subject' => 'Greetings',
            'message' => 'Hello there',
        ]);

        MessageGlue::create([
            'message_id' => $message->message_id,
            'from_id' => $sender->player_id,
            'to_id' => $recipient->player_id,
            'send_date' => now(),
        ]);

        $response = $this->withSession(['player_id' => $recipient->player_id])->get('/messages');

        $response->assertStatus(200);
        $response->assertSee('Greetings');
    }

    public function test_user_can_send_message(): void
    {
        $sender = Player::factory()->create();
        $recipient = Player::factory()->create();

        $response = $this->withSession(['player_id' => $sender->player_id])->post('/messages', [
            'to_id' => $recipient->player_id,
            'subject' => 'Hi',
            'message' => 'Test message',
        ]);

        $response->assertRedirect('/messages');
        $this->assertDatabaseHas('messages', ['subject' => 'Hi']);
        $this->assertDatabaseHas('message_glues', [
            'from_id' => $sender->player_id,
            'to_id' => $recipient->player_id,
        ]);
    }
}
