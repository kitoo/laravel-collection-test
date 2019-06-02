<?php

namespace Tests\Unit\Decision;

use Tests\TestCase;

class IsEmptyTest extends TestCase
{
    public function testSimpleTruthyCase()
    {
        $result = collect()
            ->isEmpty()
        ;

        $this->assertTrue($result);
    }

    public function testSimpleFalsyCase()
    {
        $result = collect([null,])
            ->isEmpty()
        ;

        $this->assertFalse($result);
    }
}
