<?php

namespace Tests\Feature;

use App\Models\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_form_displays(): void
    {
        $player = Player::factory()->create();
        $response = $this->withSession(['player_id' => $player->player_id])->get('/profile');
        $response->assertStatus(200);
    }

    public function test_user_can_update_profile(): void
    {
        $player = Player::factory()->create([
            'password' => Player::hashPassword('oldpass'),
            'alt_pass' => Player::hashAltPass('oldpass'),
        ]);

        $response = $this->withSession(['player_id' => $player->player_id])->post('/profile', [
            'first_name' => 'New',
            'last_name' => 'Name',
            'email' => 'new@example.com',
            'timezone' => 'UTC',
            'current_password' => 'oldpass',
            'password' => 'newpass',
            'password_confirmation' => 'newpass',
        ]);

        $response->assertRedirect('/profile');
        $this->assertDatabaseHas('player', [
            'player_id' => $player->player_id,
            'first_name' => 'New',
            'email' => 'new@example.com',
        ]);
    }
}
