<?php

namespace Tests\Unit\Decision;

use Tests\TestCase;

class CountTest extends TestCase
{
    public function testEmptyCase()
    {
        $result = collect()
            ->count()
        ;

        $this->assertSame(
            0,
            $result
        );
    }

    public function testSimpleCase()
    {
        $result = collect([null,])
            ->count()
        ;

        $this->assertEquals(
            1,
            $result
        );
    }
}
