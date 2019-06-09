<?php

namespace Tests\Unit\Decision;

use Tests\TestCase;

class MaxTest extends TestCase
{
    public function testEmptyCase()
    {
        $result = collect()
            ->max()
        ;

        $this->assertSame(
            null,
            $result
        );
    }

    public function testNullCase()
    {
        $result = collect([null,])
            ->max()
        ;

        $this->assertSame(
            null,
            $result
        );
    }

    public function testIntegerArrayCase()
    {
        $result = collect([1, 2, 3,])
            ->max()
        ;

        $this->assertEquals(
            3,
            $result
        );
    }

    public function testStringArrayCase()
    {
        $result = collect(['1a', '2b', '3c',])
            ->max()
        ;

        $this->assertEquals(
            '3c',
            $result
        );
    }

    public function testAssocCase()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->max()
        ;

        $this->assertEquals(
            3,
            $result
        );
    }

    public function testNestAssocCaseWithKey()
    {
        $resultOfPluckMax = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
            ['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->pluck('a')
            ->max()
        ;

        $resultOfMax = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
            ['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->max('a')
        ;

        $this->assertEquals(
            $resultOfPluckMax,
            $resultOfMax
        );
        $this->assertEquals(
            7,
            $resultOfMax
        );
    }

    public function testObjectArrayCaseWithKey()
    {
        $resultOfPluckMax = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
            (object)['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->pluck('a')
            ->max()
        ;

        $resultOfMax = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
            (object)['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->max('a')
        ;

        $this->assertEquals(
            $resultOfPluckMax,
            $resultOfMax
        );
        $this->assertEquals(
            7,
            $resultOfMax
        );
    }

    public function testClosureCase()
    {
        $result = collect([
            collect(['a' => 1, 'b' => 2, 'c' => 3,]),
            collect(['a' => 4, 'b' => 5, 'c' => 6,]),
            collect(['a' => 7, 'b' => 8, 'c' => 9,]),
        ])
            ->max(function ($array) {
                return $array->sum();
            })
        ;

        $this->assertEquals(
            24,
            $result
        );
    }
}
