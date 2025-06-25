<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConquerLimitTableTest extends TestCase
{
    use RefreshDatabase;
    public function test_conquer_limit_table_builds_values(): void
    {
        $data = [
            'conquer_type' => 'trade_value',
            'conquer_conquests_per' => 1,
            'conquer_per_number' => 10,
            'conquer_skip' => 0,
            'conquer_start_at' => 0,
            'conquer_minimum' => 1,
            'conquer_maximum' => 5,
        ];
        $html = conquer_limit_table($data);
        $this->assertStringContainsString('Conquer Limit', $html);
        $this->assertStringContainsString('<td>1</td>', $html);
    }

    public function test_calculate_conquer_limit_returns_value(): void
    {
        $game = \App\Models\Game::factory()->create([
            'extra_info' => json_encode([
                'conquer_type' => 'trade_count',
                'conquer_conquests_per' => 1,
                'conquer_per_number' => 2,
                'conquer_skip' => 0,
                'conquer_start_at' => 0,
                'conquer_minimum' => 1,
                'conquer_maximum' => 5,
                'trade_count' => 2,
            ]),
        ]);
        $player = \App\Models\GamePlayer::factory()->create([
            'game_id' => $game->game_id,
            'player_id' => 1,
            'extra_info' => json_encode(['conquered' => 1, 'round' => 1, 'turn' => 1]),
        ]);
        $limit = calculate_conquer_limit($game, $player);
        $this->assertSame(2, $limit);
    }
}
