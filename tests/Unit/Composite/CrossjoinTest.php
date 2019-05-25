<?php

namespace Tests\Unit\Composite;

use Tests\TestCase;

class CrossjoinTest extends TestCase
{

    public function testSimpleCase()
    {
        $result = collect([1, 2, 3,])
            ->crossjoin(['a', 'b', 'c',])
        ;

        $this->assertEquals(
            [
                [1, 'a',], [1, 'b',], [1, 'c',],
                [2, 'a',], [2, 'b',], [2, 'c',],
                [3, 'a',], [3, 'b',], [3, 'c',],
            ],
            $result->toArray()
        );
    }

    public function testAssocCase()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->crossjoin(['b' => 3, 'c' => 6, 'a' => 9, ])
        ;

        // not key but position
        $this->assertEquals(
            [
                [1, 3,], [1, 6,], [1, 9,],
                [2, 3,], [2, 6,], [2, 9,],
                [3, 3,], [3, 6,], [3, 9,],
            ],
            $result->toArray()
        );
    }

    public function testWrongMultipleCase()
    {
        $result = collect([1, 2,])
            ->crossjoin(['a', 'b',])
            ->crossjoin(['A', 'B', ])
        ;

        // not expected result
        $this->assertEquals(
            [
                [[1, 'a',], 'A',], [[1, 'a',], 'B',],
                [[1, 'b',], 'A',], [[1, 'b',], 'B',],
                [[2, 'a',], 'A',], [[2, 'a',], 'B',],
                [[2, 'b',], 'A',], [[2, 'b',], 'B',],
            ],
            $result->toArray()
        );
    }

    public function testCorrectMultipleCase()
    {
        $result = collect([1, 2,])
            ->crossjoin(['a', 'b',], ['A', 'B',])
        ;

        $this->assertEquals(
            [
                [1, 'a', 'A',], [1, 'a', 'B',],
                [1, 'b', 'A',], [1, 'b', 'B',],
                [2, 'a', 'A',], [2, 'a', 'B',],
                [2, 'b', 'A',], [2, 'b', 'B',],
            ],
            $result->toArray()
        );
    }

    public function testRidiculousCase()
    {
        $result = collect([1, 2, 3,])
            ->crossjoin('a', 'b', 'c')
        ;

        $this->assertEquals(
            [[1, 'a', 'b', 'c',], [2, 'a', 'b', 'c',], [3, 'a', 'b', 'c',],],
            $result->toArray()
        );
    }

    public function testLoopWithMultipleNestsCase()
    {
        $firstArray = [1, 2,];
        $secondArray = ['a', 'b',];
        $thirdArray = ['A', 'B',];

        $simpleHonestyResult = collect($firstArray)
            ->flatMap(function ($first) use ($secondArray, $thirdArray) {
                return collect($secondArray)
                    ->flatMap(function ($second) use ($first, $thirdArray) {
                        return collect($thirdArray)
                            ->map(function ($third) use ($first, $second) {
                                return "{$first}-{$second}-{$third}";
                            });
                    });
            })
        ;
        $smartResult = collect($firstArray)
            ->crossjoin($secondArray, $thirdArray)
            ->mapSpread(function ($first, $second, $third) {
                return "{$first}-{$second}-{$third}";
            })
        ;

        $this->assertEquals(
            $simpleHonestyResult,
            $smartResult
        );
        $this->assertEquals(
            [
                '1-a-A', '1-a-B',
                '1-b-A', '1-b-B',
                '2-a-A', '2-a-B',
                '2-b-A', '2-b-B',
            ],
            $smartResult->toArray()
        );
    }
}
