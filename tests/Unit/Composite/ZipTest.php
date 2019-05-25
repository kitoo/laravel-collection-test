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
        $this->assertEquals([[1, 'a',], [2, 'b',], [3, 'c',],], $result->toArray());
    }

    public function testAssocCase()
    {
        // not key but position
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->zip(['d' => 3, 'e' => 6, 'f' => 9, ])
        ;
        $this->assertEquals([[1, 3,], [2, 6,], [3, 9,],], $result->toArray());
    }

    public function testWrongMultipleCase()
    {
        $result = collect([1, 2, 3,])
            ->zip(['a', 'b', 'c',])
            ->zip(['A', 'B', 'C',])
        ;
        // not expected result
        $this->assertEquals([[[1, 'a',], 'A',], [[2, 'b',], 'B',], [[3, 'c',], 'C',],], $result->toArray());
    }

    public function testCollectMultipleCase()
    {
        $result = collect([1, 2, 3,])
            ->zip(['a', 'b', 'c',], ['A', 'B', 'C',])
        ;

        $this->assertEquals([[1, 'a', 'A',], [2, 'b', 'B',], [3, 'c', 'C',],], $result->toArray());
    }

    public function testRidiculousCase()
    {
        $result = collect([1, 2, 3,])
            ->zip('a', 'b', 'c')
        ;

        $this->assertEquals([[1, 'a', 'b', 'c',], [2, null, null, null,], [3, null, null, null,],], $result->toArray());
    }
}
