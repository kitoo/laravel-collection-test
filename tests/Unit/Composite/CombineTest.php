<?php

namespace Tests\Unit\Composite;

use Tests\TestCase;

class CombineTest extends TestCase
{

    public function testSimpleCase()
    {
        $result = collect([1, 2, 3,])
            ->combine(['a', 'b', 'c',])
        ;

        $this->assertEquals(
            [1 => 'a', 2 => 'b', 3 => 'c',],
            $result->toArray()
        );
    }

    public function testAssocCase()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->combine(['b' => 3, 'c' => 6, 'a' => 9, ])
        ;

        // not key but position
        $this->assertEquals([1 => 3, 2 => 6, 3 => 9,], $result->toArray());
    }
}
