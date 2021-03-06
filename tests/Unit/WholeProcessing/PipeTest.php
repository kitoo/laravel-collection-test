<?php

namespace Tests\Unit\WholeProcessing;

use Illuminate\Support\Collection;
use Tests\TestCase;

class PipeTest extends TestCase
{
    public function testSimpleCase()
    {
        $result = collect([1, 2, 3,])
            ->pipe(function ($collection) {
                return strval($collection);
            })
        ;

        $this->assertEquals(
            "[1,2,3]",
            $result
        );
    }

    public function testCaseWithSideEffect()
    {
        $collection = collect([1, 2, 3,]);
        $result = $collection
            ->pipe(function ($collection) {
                return $collection->push(9);
            })
        ;

        $this->assertEquals(
            [1, 2, 3, 9,],
            $result->all()
        );
        // has side effect
        $this->assertEquals(
            [1, 2, 3, 9,],
            $collection->all()
        );
    }
}
