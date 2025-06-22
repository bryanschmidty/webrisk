<?php

namespace Tests\Unit;

use App\Models\Player;
use Tests\TestCase;

class PlayerHashingTest extends TestCase
{
    public function test_hash_password(): void
    {
        $expected = md5('secret'.'NUTTY!SALT');
        $this->assertSame($expected, Player::hashPassword('secret'));
    }

    public function test_hash_alt_pass(): void
    {
        $password = 'secret';
        $expected = md5(str_rot13($password).substr(md5(md5(strrev($password)).md5($password)), 10, 32).'SALTY!NUTS');
        $this->assertSame($expected, Player::hashAltPass($password));
    }
}
