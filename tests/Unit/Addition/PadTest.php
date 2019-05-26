<?php

namespace Tests\Unit\Addition;

use Tests\TestCase;

class PadTest extends TestCase
{
    public function testSimpleCase()
    {
        $result = collect([1, 2, 3,])
            ->pad(5, 'a')
        ;

        $this->assertEquals(
            [1, 2, 3, 'a', 'a',],
            $result->toArray()
        );
    }

    public function testSimpleCaseWithNegativeInteger()
    {
        $result = collect([1, 2, 3,])
            ->pad(-5, 'a')
        ;

        $this->assertEquals(
            ['a', 'a', 1, 2, 3,],
            $result->toArray()
        );
    }

    public function testRidiculousCaseWithIntegerKeys()
    {
        $result = collect([1, 2, 3,])
            ->pad(5, ['a', 'b',])
        ;

        $this->assertEquals(
            [1, 2, 3, ['a', 'b',], ['a', 'b',],],
            $result->toArray()
        );
    }

    public function testRepeatElementsCase()
    {
        $resultOfFill = array_fill(0, 5, 'abc');

        // = ['abc',] * 5
        $resultOfPad = collect()
            ->pad(5, 'abc')
        ;

        $this->assertEquals(
            $resultOfFill,
            $resultOfPad->toArray()
        );
        $this->assertEquals(
            ['abc', 'abc', 'abc', 'abc', 'abc',],
            $resultOfPad->toArray()
        );
    }

}
