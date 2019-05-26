<?php

namespace Tests\Unit\WholeProcessing;

use Illuminate\Support\Collection;
use Tests\TestCase;

class TapTest extends TestCase
{
    public function testSimpleCase()
    {
        $result = collect([1, 2, 3,])
            ->tap(function ($collection) {
                return strval($collection);
            })
        ;

        // closure's return value is thrown away
        $this->assertEquals(
            [1, 2, 3,],
            $result->all()
        );
    }

    public function testCaseWithSideEffect()
    {
        $collection = collect([1, 2, 3,]);
        $result = $collection
            ->tap(function ($collection) {
                return $collection->push(9);
            })
        ;

        // has NOT side effect
        $this->assertEquals(
            [1, 2, 3,],
            $collection->all()
        );
    }

    public function testNestCaseWithSideEffect()
    {
        $collection = collect([collect([1, 2, 3,]), collect(['a', 'b', 'c',]),]);
        $result = $collection
            ->tap(function ($collection) {
                $collection->first()->push(9);
                return $collection;
            })
        ;

        // has side effect !!!
        $this->assertEquals(
            [[1, 2, 3, 9,], ['a', 'b', 'c',],],
            $collection->toArray()
        );
    }
}
