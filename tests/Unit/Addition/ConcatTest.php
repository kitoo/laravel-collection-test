<?php

namespace Tests\Unit\Addition;

use Tests\TestCase;

class ConcatTest extends TestCase
{
    public function testSimpleCase()
    {
        $result = collect([1, 2, 3,])
            ->concat(['a', 'b', 'c',])
        ;

        $this->assertEquals(
            [1, 2, 3, 'a', 'b', 'c',],
            $result->all()
        );
    }

    public function testNotArrayableCase()
    {
        // throw Exception
        $this->expectException(\ErrorException::class);

        $result = collect([1, 2, 3,])
            ->concat(4)
        ;
    }

    public function testAssocWithStringkeysCase()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->concat(['d' => 3, 'e' => 6, 'f' => 9, ])
        ;

        // ignored keys on param array. but remaining keys on base array
        $this->assertEquals(
            ['a' => 1, 'b' => 2, 'c' => 3, 0 => 3, 1 => 6, 2 => 9,],
            $result->all()
        );
    }

    public function testAssocWithIntegerkeysCase()
    {
        $result = collect([2 => 'b', 3 => 'c', 1 => 'a',])
            ->concat([1 => 'd', 2 => 'e', 3 => 'f',])
        ;

        $this->assertEquals(
            [2 => 'b', 3 => 'c', 1 => 'a', 4 => 'd', 5 => 'e', 6 => 'f',],
            $result->all()
        );
    }
}
