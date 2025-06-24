<?php

namespace Tests\Unit;

use Tests\TestCase;

class ConquerLimitTableTest extends TestCase
{
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
}
