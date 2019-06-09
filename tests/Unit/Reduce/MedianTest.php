<?php

namespace Tests\Unit\Decision;

use Tests\TestCase;

class MedianTest extends TestCase
{
    public function testEmptyCase()
    {
        $result = collect()
            ->median()
        ;

        $this->assertSame(
            null,
            $result
        );
    }

    public function testNullCase()
    {
        $result = collect([null,])
            ->median()
        ;

        $this->assertSame(
            null,
            $result
        );
    }

    public function testIntegerArrayCase()
    {
        $result = collect([5, 1, 2, 6, 4, 3,])
            ->median()
        ;

        $this->assertEquals(
            3.5,
            $result
        );
    }

    public function testStringArrayCase()
    {
        $result = collect(['5', '1', '2', '6', '4', '3',])
            ->median()
        ;

        $this->assertEquals(
            3.5,
            $result
        );
    }

    public function testAssocCase()
    {
        $result = collect(['a' => 5, 'b' => 1, 'c' => 2,])
            ->median()
        ;

        $this->assertEquals(
            2,
            $result
        );
    }

    public function testNestAssocRidiculousCase()
    {
        $result = collect([
            collect(['a' => 1, 'b' => 2, 'c' => 3,]),
            collect(['a' => 7, 'b' => 8, 'c' => 9,]),
            collect(['a' => 4, 'b' => 5, 'c' => 6,]),
        ])
            ->median()
        ;

        $this->assertEquals(
            collect(['a' => 4, 'b' => 5, 'c' => 6,]),
            $result
        );
    }

    public function testNestAssocCaseWithKey()
    {
        $resultOfPluckMedian = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
            ['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->pluck('a')
            ->median()
        ;

        $resultOfMedian = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
            ['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->median('a')
        ;

        $this->assertEquals(
            $resultOfPluckMedian,
            $resultOfMedian
        );
        $this->assertEquals(
            4,
            $resultOfMedian
        );
    }

    public function testObjectArrayCaseWithKey()
    {
        $resultOfPluckMedian = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
            (object)['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->pluck('a')
            ->median()
        ;

        $resultOfMedian = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
            (object)['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->median('a')
        ;

        $this->assertEquals(
            $resultOfPluckMedian,
            $resultOfMedian
        );
        $this->assertEquals(
            4,
            $resultOfMedian
        );
    }
}
