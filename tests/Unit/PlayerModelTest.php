<?php

namespace Tests\Unit;

use App\Models\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlayerModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_player_can_be_created(): void
    {
        $player = Player::factory()->create();
        $this->assertDatabaseHas('player', ['player_id' => $player->player_id]);
    }
}
