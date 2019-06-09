<?php

namespace Tests\Unit\Decision;

use Tests\TestCase;

class SumTest extends TestCase
{
    public function testEmptyCase()
    {
        $result = collect()
            ->sum()
        ;

        $this->assertSame(
            0,
            $result
        );
    }

    public function testNullCase()
    {
        $result = collect([null,])
            ->sum()
        ;

        $this->assertSame(
            0,
            $result
        );
    }

    public function testIntegerArrayCase()
    {
        $result = collect([1, 2, 3,])
            ->sum()
        ;

        $this->assertEquals(
            6,
            $result
        );
    }

    public function testStringArrayCase()
    {
        $result = collect(['1a', '2b', '3c',])
            ->sum()
        ;

        $this->assertEquals(
            6,
            $result
        );
    }

    public function testAssocCase()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->sum()
        ;

        $this->assertEquals(
            6,
            $result
        );
    }

    public function testNestAssocRidiculousCase()
    {
        $result = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
            ['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->sum()
        ;

        $this->assertEquals(
            0,
            $result
        );
    }

    public function testNestAssocCaseWithKey()
    {
        $resultOfPluckSum = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
            ['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->pluck('a')
            ->sum()
        ;

        $resultOfSum = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
            ['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->sum('a')
        ;

        $this->assertEquals(
            $resultOfPluckSum,
            $resultOfSum
        );
        $this->assertEquals(
            12,
            $resultOfSum
        );
    }

    public function testObjectArrayCaseWithKey()
    {
        $resultOfPluckSum = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
            (object)['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->pluck('a')
            ->sum()
        ;

        $resultOfSum = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
            (object)['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->sum('a')
        ;

        $this->assertEquals(
            $resultOfPluckSum,
            $resultOfSum
        );
        $this->assertEquals(
            12,
            $resultOfSum
        );
    }

    public function testClosureCase()
    {
        $result = collect([
            collect(['a' => 1, 'b' => 2, 'c' => 3,]),
            collect(['a' => 4, 'b' => 5, 'c' => 6,]),
            collect(['a' => 7, 'b' => 8, 'c' => 9,]),
        ])
            ->sum(function ($array) {
                return $array->sum();
            })
        ;

        $this->assertEquals(
            45,
            $result
        );
    }

    public function testHigherOrderCase()
    {
        $result = collect([
            collect(['a' => 1, 'b' => 2, 'c' => 3,]),
            collect(['a' => 4, 'b' => 5, 'c' => 6,]),
            collect(['a' => 7, 'b' => 8, 'c' => 9,]),
        ])
            // Higher Order Message
            ->sum->sum()
        ;

        $this->assertEquals(
            45,
            $result
        );
    }

}
