<?php

namespace Tests\Unit;

use App\Models\{Game, GameLog};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameTradeValueTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_trade_value_returns_zero_when_no_logs(): void
    {
        $game = Game::factory()->create();
        $this->assertSame(0, $game->get_trade_value());
    }

    public function test_get_trade_value_returns_latest_value(): void
    {
        $game = Game::factory()->create();
        GameLog::create([
            'game_id' => $game->game_id,
            'data' => 'V - Value for Trade - [4]',
            'create_date' => now()->subMinute(),
            'microsecond' => 0,
        ]);
        GameLog::create([
            'game_id' => $game->game_id,
            'data' => 'V - Value for Trade - [7]',
            'create_date' => now(),
            'microsecond' => 0,
        ]);
        $this->assertSame(7, $game->get_trade_value());
    }
}
