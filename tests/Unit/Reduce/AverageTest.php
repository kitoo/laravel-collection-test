<?php

namespace Tests\Unit\Decision;

use Tests\TestCase;

class AverageTest extends TestCase
{
    public function testEmptyCase()
    {
        $result = collect()
            ->average()
        ;

        $this->assertSame(
            null,
            $result
        );
    }

    public function testNullCase()
    {
        $result = collect([null, null,])
            ->average()
        ;

        $this->assertSame(
            null,
            $result
        );
    }

    public function testIncludedNullCase()
    {
        $result = collect([1, null, 3,])
            ->average()
        ;

        // null is just ignored
        $this->assertEquals(
            2,
            $result
        );
    }

    public function testIntegerArrayCase()
    {
        $result = collect([1, 2, 3,])
            ->average()
        ;

        $this->assertEquals(
            2,
            $result
        );
    }

    public function testStringArrayCase()
    {
        $result = collect(['1a', '2b', '3c',])
            ->average()
        ;

        $this->assertEquals(
            2,
            $result
        );
    }

    public function testAssocCase()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->average()
        ;

        $this->assertEquals(
            2,
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
            ->average()
        ;

        $this->assertEquals(
            0,
            $result
        );
    }

    public function testNestAssocCaseWithKey()
    {
        $resultOfPluckAverage = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
            ['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->pluck('a')
            ->average()
        ;

        $resultOfAverage = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
            ['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->average('a')
        ;

        $this->assertEquals(
            $resultOfPluckAverage,
            $resultOfAverage
        );
        $this->assertEquals(
            4,
            $resultOfAverage
        );
    }

    public function testObjectArrayCaseWithKey()
    {
        $resultOfPluckAverage = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
            (object)['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->pluck('a')
            ->average()
        ;

        $resultOfAverage = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
            (object)['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->average('a')
        ;

        $this->assertEquals(
            $resultOfPluckAverage,
            $resultOfAverage
        );
        $this->assertEquals(
            4,
            $resultOfAverage
        );
    }

    public function testClosureCase()
    {
        $result = collect([
            collect(['a' => 1, 'b' => 2, 'c' => 3,]),
            collect(['a' => 4, 'b' => 5, 'c' => 6,]),
            collect(['a' => 7, 'b' => 8, 'c' => 9,]),
        ])
            ->average(function ($array) {
                return $array->sum();
            })
        ;

        $this->assertEquals(
            15,
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
            ->average->sum()
        ;

        $this->assertEquals(
            15,
            $result
        );
    }
}
