<?php

namespace Tests\Unit\Decision;

use Tests\TestCase;

class MinTest extends TestCase
{
    public function testEmptyCase()
    {
        $result = collect()
            ->min()
        ;

        $this->assertSame(
            null,
            $result
        );
    }

    public function testNullCase()
    {
        $result = collect([null,])
            ->min()
        ;

        $this->assertSame(
            null,
            $result
        );
    }

    public function testIntegerArrayCase()
    {
        $result = collect([1, 2, 3,])
            ->min()
        ;

        $this->assertEquals(
            1,
            $result
        );
    }

    public function testStringArrayCase()
    {
        $result = collect(['1a', '2b', '3c',])
            ->min()
        ;

        $this->assertEquals(
            '1a',
            $result
        );
    }

    public function testAssocCase()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->min()
        ;

        $this->assertEquals(
            1,
            $result
        );
    }

    public function testNestAssocCaseWithKey()
    {
        $resultOfPluckMin = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
            ['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->pluck('a')
            ->min()
        ;

        $resultOfMin = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
            ['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->min('a')
        ;

        $this->assertEquals(
            $resultOfPluckMin,
            $resultOfMin
        );
        $this->assertEquals(
            1,
            $resultOfMin
        );
    }

    public function testObjectArrayCaseWithKey()
    {
        $resultOfPluckMin = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
            (object)['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->pluck('a')
            ->min()
        ;

        $resultOfMin = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
            (object)['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->min('a')
        ;

        $this->assertEquals(
            $resultOfPluckMin,
            $resultOfMin
        );
        $this->assertEquals(
            1,
            $resultOfMin
        );
    }

    public function testClosureCase()
    {
        $result = collect([
            collect(['a' => 1, 'b' => 2, 'c' => 3,]),
            collect(['a' => 4, 'b' => 5, 'c' => 6,]),
            collect(['a' => 7, 'b' => 8, 'c' => 9,]),
        ])
            ->min(function ($array) {
                return $array->sum();
            })
        ;

        $this->assertEquals(
            6,
            $result
        );
    }
}
