<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\GameLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_history_page_displays_logs(): void
    {
        $game = Game::factory()->create();
        GameLog::factory()->create([
            'game_id' => $game->game_id,
            'data' => 'Log entry',
        ]);

        $response = $this->get('/games/' . $game->game_id . '/history');

        $response->assertStatus(200);
        $response->assertSee('Log entry');
    }

    public function test_review_page_displays_file(): void
    {
        $path = storage_path('app/private/test.log');
        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0777, true);
        }
        file_put_contents($path, 'File contents');

        $response = $this->get('/review/test.log');

        $response->assertStatus(200);
        $response->assertSee('File contents');
    }
}
