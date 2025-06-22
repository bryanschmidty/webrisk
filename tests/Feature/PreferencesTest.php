<?php

namespace Tests\Feature;

use App\Models\Player;
use App\Models\PlayerSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PreferencesTest extends TestCase
{
    use RefreshDatabase;

    public function test_preferences_form_displays(): void
    {
        $player = Player::factory()->create();
        PlayerSettings::create(['player_id' => $player->player_id]);
        $response = $this->withSession(['player_id' => $player->player_id])->get('/prefs');
        $response->assertStatus(200);
    }

    public function test_player_can_update_preferences(): void
    {
        $player = Player::factory()->create();
        PlayerSettings::create(['player_id' => $player->player_id]);

        $response = $this->withSession(['player_id' => $player->player_id])->post('/prefs', [
            'allow_email' => '1',
            'invite_opt_out' => '1',
            'max_games' => 3,
            'color' => 'red_black',
        ]);

        $response->assertRedirect('/prefs');
        $this->assertDatabaseHas('wr_player', [
            'player_id' => $player->player_id,
            'allow_email' => 1,
            'invite_opt_out' => 1,
            'max_games' => 3,
            'color' => 'red_black',
        ]);
    }
}
