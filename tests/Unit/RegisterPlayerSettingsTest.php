<?php

namespace Tests\Unit;

use App\Models\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterPlayerSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_settings_created_on_register(): void
    {
        $this->post('/register', [
            'username' => 'tester',
            'email' => 'tester@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $player = Player::first();
        $this->assertDatabaseHas('wr_player', ['player_id' => $player->player_id]);
    }
}
