<?php

namespace Tests\Unit\Addition;

use Tests\TestCase;

class UnionTest extends TestCase
{
    public function testSimpleCase()
    {
        $result = collect([1, 2, 3,])
            ->union(['a', 'b', 'c',])
        ;

        // not expected result
        $this->assertEquals(
            [1, 2, 3,],
            $result->toArray()
        );
    }

    public function testNotArrayableCase()
    {
        $result = collect([1, 2, 3,])
            ->union(4)
        ;

        // not expected result
        $this->assertEquals(
            [1, 2, 3,],
            $result->toArray()
        );
    }

    public function testAssocWithStringkeysCase()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->union(['d' => 3, 'e' => 6, 'f' => 9, ])
        ;

        // reserve keys
        $this->assertEquals(
            ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 3, 'e' => 6, 'f' => 9,],
            $result->toArray()
        );
    }

    public function testAssocWithDuplicateStringkeysCase()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->union(['b' => 3, 'c' => 6, 'a' => 9, ])
        ;

        // first come, first served
        $this->assertEquals(
            ['a' => 1, 'b' => 2, 'c' => 3,],
            $result->toArray()
        );
    }

    public function testAssocWithIntegerkeysCase()
    {
        $result = collect([2 => 'b', 3 => 'c', 1 => 'a',])
            ->union([1 => 'd', 2 => 'e', 3 => 'f',])
        ;

        // first come, first served
        $this->assertEquals(
            [2 => 'b', 3 => 'c', 1 => 'a',],
            $result->toArray()
        );
    }

    public function testAssocWithIntegerAsStringkeysCase()
    {
        $result = collect(['2' => 'b', '3' => 'c', '1' => 'a',])
            ->union(['1' => 'd', '2' => 'e', '3' => 'f',])
        ;

        // first come, first served
        $this->assertEquals(
            ['2' => 'b', '3' => 'c', '1' => 'a',],
            $result->toArray()
        );
    }
}
