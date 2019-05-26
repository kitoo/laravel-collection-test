<?php

namespace Tests\Unit\Addition;

use Tests\TestCase;

class PutTest extends TestCase
{
    public function testSimpleCase()
    {
        $result = collect([1, 2, 3,])
            ->put(1, 5) // $key, $value
        ;

        $this->assertEquals(
            [1, 5, 3,],
            $result->toArray()
        );
    }

    public function testSimpleCaseWithKey()
    {
        $result = collect([1 => 'a', 2 => 'b', 3 => 'c',])
            ->put(9, 'z')
        ;

        $this->assertEquals(
            [1 => 'a', 2 => 'b', 3 => 'c', 9 => 'z',],
            $result->toArray()
        );
    }

    public function testAssocWithStringkeysCase()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->put('a', 9)
        ;

        // overwitten
        $this->assertEquals(
            ['a' => 9, 'b' => 2, 'c' => 3,],
            $result->toArray()
        );
    }
}
