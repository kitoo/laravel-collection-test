<?php

namespace Tests\Unit\Addition;

use Tests\TestCase;

class PushTest extends TestCase
{
    public function testSimpleCase()
    {
        $result = collect([1, 2, 3,])
            ->push(0)
        ;

        $this->assertEquals(
            [1, 2, 3, 0,],
            $result->toArray()
        );
    }

    public function testSimpleCaseWithKey()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->push('z')
        ;

        $this->assertEquals(
            ['a' => 1, 'b' => 2, 'c' => 3, 0 => 'z',],
            $result->toArray()
        );
    }
}
