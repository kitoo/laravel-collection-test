<?php

namespace Tests\Unit\Decision;

use Tests\TestCase;

class ModeTest extends TestCase
{
    public function testEmptyCase()
    {
        $result = collect()
            ->mode()
        ;

        $this->assertSame(
            null,
            $result
        );
    }

    public function testNullCase()
    {
        $result = collect([null,])
            ->mode()
        ;

        $this->assertSame(
            [0,],
            $result
        );
    }

    public function testIntegerArrayCase()
    {
        $result = collect([3, 2, 1, 3, 1,])
            ->mode()
        ;

        $this->assertEquals(
            [3, 1,],
            $result
        );
    }

    public function testStringArrayCase()
    {
        $result = collect(['3', '2', '1', '3', '1',])
            ->mode()
        ;

        $this->assertEquals(
            [3, 1,],
            $result
        );
    }

    public function testAssocCase()
    {
        $result = collect(['a' => 3, 'b' => 1, 'c' => 3,])
            ->mode()
        ;

        $this->assertEquals(
            [3,],
            $result
        );
    }

    public function testNestAssocRidiculousCase()
    {
        // throw Exception
        $this->expectException(\ErrorException::class);

        $result = collect([
            collect(['a' => 1, 'b' => 2, 'c' => 3,]),
            collect(['a' => 7, 'b' => 8, 'c' => 9,]),
            collect(['a' => 4, 'b' => 5, 'c' => 6,]),
        ])
            ->mode()
        ;
    }

    public function testNestAssocCaseWithKey()
    {
        $resultOfPluckMode = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
            ['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->pluck('a')
            ->mode()
        ;

        $resultOfMode = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
            ['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->mode('a')
        ;

        $this->assertEquals(
            $resultOfPluckMode,
            $resultOfMode
        );
        $this->assertEquals(
            [1, 4, 7,],
            $resultOfMode
        );
    }

    public function testObjectArrayCaseWithKey()
    {
        $resultOfPluckMode = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
            (object)['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->pluck('a')
            ->mode()
        ;

        $resultOfMode = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
            (object)['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->mode('a')
        ;

        $this->assertEquals(
            $resultOfPluckMode,
            $resultOfMode
        );
        $this->assertEquals(
            [1, 4, 7,],
            $resultOfMode
        );
    }
}
