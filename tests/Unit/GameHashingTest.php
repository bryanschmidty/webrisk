<?php

namespace Tests\Unit;

use App\Models\Game;
use Tests\TestCase;

class GameHashingTest extends TestCase
{
    public function test_hash_password(): void
    {
        $password = 'secret';
        $expected = md5($password.'s41Ty!S7uFF');
        $this->assertSame($expected, Game::hashPassword($password));
    }
}
