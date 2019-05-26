<?php

namespace Tests\Unit\Addition;

use Tests\TestCase;

class MergeTest extends TestCase
{
    public function testSimpleCase()
    {
        $result = collect([1, 2, 3,])
            ->merge(['a', 'b', 'c',])
        ;

        $this->assertEquals(
            [1, 2, 3, 'a', 'b', 'c',],
            $result->all()
        );
    }

    public function testNotArrayableCase()
    {
        $result = collect([1, 2, 3,])
            ->merge(4)
        ;

        // not Arrayable param is also OK
        $this->assertEquals(
            [1, 2, 3, 4,],
            $result->all()
        );
    }

    public function testAssocWithStringkeysCase()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->merge(['d' => 3, 'e' => 6, 'f' => 9, ])
        ;

        // reserve keys
        $this->assertEquals(
            ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 3, 'e' => 6, 'f' => 9,],
            $result->all()
        );
    }

    public function testAssocWithDuplicateStringkeysCase()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->merge(['b' => 3, 'c' => 6, 'a' => 9,])
        ;

        // last come, first served
        $this->assertEquals(
            ['a' => 9, 'b' => 3, 'c' => 6,],
            $result->all()
        );
    }

    public function testAssocWithIntegerkeysCase()
    {
        $result = collect([2 => 'b', 3 => 'c', 1 => 'a',])
            ->merge([1 => 'd', 2 => 'e', 3 => 'f',])
        ;

        // reserve not keys but position
        $this->assertEquals(
            [0 => 'b', 1 => 'c', 2 => 'a', 3 => 'd', 4 => 'e', 5 => 'f',],
            $result->all()
        );
    }

    public function testAssocWithIntegerAsStringkeysCase()
    {
        $result = collect(['2' => 'b', '3' => 'c', '1' => 'a',])
            ->merge(['1' => 'd', '2' => 'e', '3' => 'f',])
        ;

        // reserve not keys but position
        $this->assertEquals(
            [0 => 'b', 1 => 'c', 2 => 'a', 3 => 'd', 4 => 'e', 5 => 'f',],
            $result->all()
        );
    }
}
