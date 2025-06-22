<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Game;

class ArchiveTest extends TestCase
{
    use RefreshDatabase;

    public function test_archive_page_shows_finished_games(): void
    {
        Game::factory()->create(['name' => 'Finished One', 'state' => 'Finished']);
        $response = $this->get('/archive');
        $response->assertStatus(200);
        $response->assertSee('Finished One');
    }
}
