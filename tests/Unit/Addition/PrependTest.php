<?php

namespace Tests\Unit\Addition;

use Tests\TestCase;

class PrependTest extends TestCase
{
    public function testSimpleCase()
    {
        $result = collect([1, 2, 3,])
            ->prepend(0)
        ;

        $this->assertEquals(
            [0, 1, 2, 3,],
            $result->all()
        );
    }

    public function testSimpleCaseWithKey()
    {
        $result = collect([1 => 'a', 2 => 'b', 3 => 'c',])
            ->prepend('z', 9)
        ;

        $this->assertEquals(
            [9 => 'z', 1 => 'a', 2 => 'b', 3 => 'c',],
            $result->all()
        );
    }

    public function testAssocWithStringkeysCase()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->prepend(9, 'c')
        ;

        // overwitten & moved at first
        $this->assertEquals(
            ['c' => 9, 'a' => 1, 'b' => 2,],
            $result->all()
        );
    }
}
