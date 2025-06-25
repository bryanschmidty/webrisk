<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use App\Models\{Game, GamePlayer, GameNudge, Player, Setting};

class GameNudgeTest extends TestCase
{
    use RefreshDatabase;

    public function test_nudge_creates_record(): void
    {
        Mail::fake();
        Setting::create(['setting' => 'nudge_flood_control', 'value' => '24']);

        $host = Player::factory()->create();
        $player = Player::factory()->create();
        $game = Game::factory()->create(['host_id' => $host->player_id]);

        GamePlayer::create([
            'game_id' => $game->game_id,
            'player_id' => $host->player_id,
            'order_num' => 1,
            'color' => 'red',
            'state' => 'Attacking',
            'move_date' => now(),
        ]);

        GamePlayer::create([
            'game_id' => $game->game_id,
            'player_id' => $player->player_id,
            'order_num' => 2,
            'color' => 'blue',
            'state' => 'Attacking',
            'move_date' => now()->subHours(25),
        ]);

        $this->withSession(['player_id' => $host->player_id])
            ->post('/games/' . $game->game_id . '/nudge');

        $this->assertDatabaseHas('game_nudges', [
            'game_id' => $game->game_id,
            'player_id' => $player->player_id,
        ]);
    }

    public function test_duplicate_nudge_blocked(): void
    {
        Mail::fake();
        Setting::create(['setting' => 'nudge_flood_control', 'value' => '24']);

        $host = Player::factory()->create();
        $player = Player::factory()->create();
        $game = Game::factory()->create(['host_id' => $host->player_id]);

        GamePlayer::create([
            'game_id' => $game->game_id,
            'player_id' => $host->player_id,
            'order_num' => 1,
            'color' => 'red',
            'state' => 'Attacking',
            'move_date' => now(),
        ]);

        GamePlayer::create([
            'game_id' => $game->game_id,
            'player_id' => $player->player_id,
            'order_num' => 2,
            'color' => 'blue',
            'state' => 'Attacking',
            'move_date' => now()->subHours(25),
        ]);

        $this->withSession(['player_id' => $host->player_id])
            ->post('/games/' . $game->game_id . '/nudge');

        $this->withSession(['player_id' => $host->player_id])
            ->post('/games/' . $game->game_id . '/nudge');

        $count = GameNudge::where('game_id', $game->game_id)
            ->where('player_id', $player->player_id)
            ->count();
        $this->assertEquals(1, $count);
    }

    public function test_waiting_player_nudged_during_placement(): void
    {
        Mail::fake();
        Setting::create(['setting' => 'nudge_flood_control', 'value' => '24']);

        $host = Player::factory()->create();
        $player = Player::factory()->create();
        $game = Game::factory()->create(['host_id' => $host->player_id, 'state' => 'Placing']);

        GamePlayer::create([
            'game_id' => $game->game_id,
            'player_id' => $host->player_id,
            'order_num' => 1,
            'color' => 'red',
            'state' => 'Placing',
            'move_date' => now(),
        ]);

        GamePlayer::create([
            'game_id' => $game->game_id,
            'player_id' => $player->player_id,
            'order_num' => 2,
            'color' => 'blue',
            'state' => 'Waiting',
            'move_date' => now()->subHours(25),
        ]);

        $this->withSession(['player_id' => $host->player_id])
            ->post('/games/' . $game->game_id . '/nudge');

        $this->assertDatabaseHas('game_nudges', [
            'game_id' => $game->game_id,
            'player_id' => $player->player_id,
        ]);
    }
}
