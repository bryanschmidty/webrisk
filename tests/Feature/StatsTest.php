<?php

namespace Tests\Feature;

use App\Models\Player;
use App\Models\PlayerSettings;
use App\Models\RollLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatsTest extends TestCase
{
    use RefreshDatabase;

    public function test_stats_page_displays_player_data(): void
    {
        $p1 = Player::factory()->create(['username' => 'alpha']);
        $p2 = Player::factory()->create(['username' => 'beta']);
        PlayerSettings::create(['player_id' => $p1->player_id, 'wins' => 2, 'kills' => 3, 'losses' => 1]);
        PlayerSettings::create(['player_id' => $p2->player_id, 'wins' => 1, 'kills' => 0, 'losses' => 2]);

        RollLog::create(['attack_1' => 6, 'defend_1' => 3]);
        RollLog::create(['attack_1' => 1, 'defend_1' => 5]);

        $response = $this->get('/stats');
        $response->assertStatus(200);
        $response->assertSee('Player Stats');
        $response->assertSee('alpha');
        $response->assertSee('Dice Percentages');
    }
}
