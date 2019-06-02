<?php

namespace Tests\Unit\Decision;

use Tests\TestCase;

class IsNotEmptyTest extends TestCase
{
    public function testSimpleTruthyCase()
    {
        $result = collect([null,])
            ->isNotEmpty()
        ;

        $this->assertTrue($result);
    }

    public function testSimpleFalsyCase()
    {
        $result = collect()
            ->isNotEmpty()
        ;

        $this->assertFalse($result);
    }
}
