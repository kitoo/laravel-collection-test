<?php

namespace Tests\Unit\Composite;

use Tests\TestCase;

class ZipTest extends TestCase
{

    public function testSimpleCase()
    {
        $result = collect([1, 2, 3,])
            ->zip(['a', 'b', 'c',])
        ;

        $this->assertEquals(
            [[1, 'a',], [2, 'b',], [3, 'c',],],
            $result->toArray()
        );
    }

    public function testAssocCase()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->zip(['b' => 3, 'c' => 6, 'a' => 9, ])
        ;

        // not key but position
        $this->assertEquals(
            [[1, 3,], [2, 6,], [3, 9,],],
            $result->toArray()
        );
    }

    public function testWrongMultipleCase()
    {
        $result = collect([1, 2, 3,])
            ->zip(['a', 'b', 'c',])
            ->zip(['A', 'B', 'C',])
        ;

        // not expected result
        $this->assertEquals(
            [[[1, 'a',], 'A',], [[2, 'b',], 'B',], [[3, 'c',], 'C',],],
            $result->toArray()
        );
    }

    public function testCorrectMultipleCase()
    {
        $result = collect([1, 2, 3,])
            ->zip(['a', 'b', 'c',], ['A', 'B', 'C',])
        ;

        $this->assertEquals(
            [[1, 'a', 'A',], [2, 'b', 'B',], [3, 'c', 'C',],],
            $result->toArray()
        );
    }

    public function testRidiculousCase()
    {
        $result = collect([1, 2, 3,])
            ->zip('a', 'b', 'c')
        ;

        $this->assertEquals(
            [[1, 'a', 'b', 'c',], [2, null, null, null,], [3, null, null, null,],],
            $result->toArray()
        );
    }

    public function testLoopWithMultipleArraysCase()
    {
        $firstArray = [1, 2, 3,];
        $secondArray = ['a', 'b', 'c',];
        $thirdArray = ['A', 'B', 'C',];

        $simpleHonestyResult = collect($firstArray)
            ->map(function ($first, $index) use ($secondArray, $thirdArray) {
                $second = $secondArray[$index];
                $third = $thirdArray[$index];
                return "{$first}-{$second}-{$third}";
            })
        ;
        $smartResult = collect($firstArray)
            ->zip($secondArray, $thirdArray)
            ->mapSpread(function ($first, $second, $third) {
                return "{$first}-{$second}-{$third}";
            })
        ;

        $this->assertEquals(
            $simpleHonestyResult,
            $smartResult
        );
        $this->assertEquals(
            ['1-a-A', '2-b-B', '3-c-C',],
            $smartResult->toArray()
        );
    }
}
