<?php

namespace Tests\Unit;

use Tests\TestCase;

class TradeTableTest extends TestCase
{
    public function test_trade_table_generates_rows(): void
    {
        $html = trade_table([4,6,8]);
        $this->assertStringContainsString('>1</td>', $html);
        $this->assertStringContainsString('>8</td>', $html);
    }
}
