<?php

namespace Tests\Unit\Decision;

use Tests\TestCase;

class ReduceTest extends TestCase
{
    public function testEmptyCase()
    {
        $result = collect()
            ->reduce(function ($before, $value) {
                return 12345;
            })
        ;

        $this->assertSame(
            null,
            $result
        );
    }

    public function testCountCase()
    {
        $resultOfCount = collect([1, 2, 3,])
            ->count()
        ;
        $resultOfReduce = collect([1, 2, 3,])
            ->reduce(function ($before, $value) {
                return $before + 1;
            })
        ;

        $this->assertEquals(
            $resultOfCount,
            $resultOfReduce
        );
        $this->assertEquals(
            3,
            $resultOfReduce
        );
    }

    public function testSumCase()
    {
        $resultOfSum = collect([1, 2, 3,])
            ->sum()
        ;
        $resultOfReduce = collect([1, 2, 3,])
            ->reduce(function ($before, $value) {
                return $before + $value;
            })
        ;

        $this->assertEquals(
            $resultOfSum,
            $resultOfReduce
        );
        $this->assertEquals(
            6,
            $resultOfReduce
        );
    }

    public function testImplodeCase()
    {
        $collection = collect([1, 2, 3,]);
        $resultOfImplode = $collection
            ->implode('-')
        ;
        $resultOfReduce = $collection->slice(1)
            ->reduce(function ($before, $value) {
                return $before . '-' . $value;
            }, $collection->first())
        ;

        $this->assertEquals(
            $resultOfImplode,
            $resultOfReduce
        );
        $this->assertEquals(
            '1-2-3',
            $resultOfReduce
        );
    }

    public function testMaxCase()
    {
        $resultOfMax = collect([1, 2, 3,])
            ->max()
        ;
        $resultOfReduce = collect([1, 2, 3,])
            ->reduce(function ($before, $value) {
                return is_null($before) ? $value : max($before, $value);
            })
        ;

        $this->assertEquals(
            $resultOfMax,
            $resultOfReduce
        );
        $this->assertEquals(
            3,
            $resultOfReduce
        );
    }

    public function testMinCase()
    {
        $resultOfMin = collect([1, 2, 3,])
            ->min()
        ;
        $resultOfReduce = collect([1, 2, 3,])
            ->reduce(function ($before, $value) {
                return is_null($before) ? $value : min($before, $value);
            })
        ;

        $this->assertEquals(
            $resultOfMin,
            $resultOfReduce
        );
        $this->assertEquals(
            1,
            $resultOfReduce
        );
    }
}
