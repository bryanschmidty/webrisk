<?php

namespace Tests\Unit;

use App\Models\Player;
use App\Models\PlayerSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlayerSettingsRelationTest extends TestCase
{
    use RefreshDatabase;

    public function test_player_relationship(): void
    {
        $player = Player::factory()->create();
        $settings = PlayerSettings::create(['player_id' => $player->player_id]);
        $this->assertSame($player->player_id, $settings->player->player_id);
    }
}
