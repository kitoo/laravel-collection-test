<?php

namespace Tests\Unit\Decision;

use Tests\TestCase;

class ImplodeTest extends TestCase
{
    public function testEmptyCase()
    {
        $result = collect()
            ->implode('')
        ;

        $this->assertSame(
            '',
            $result
        );
    }

    public function testNullCase()
    {
        $result = collect([null,])
            ->implode('')
        ;

        $this->assertSame(
            '',
            $result
        );
    }

    public function testIntegerArrayCase()
    {
        $result = collect([1, 2, 3,])
            ->implode('-')
        ;

        $this->assertEquals(
            '1-2-3',
            $result
        );
    }

    public function testStringArrayCase()
    {
        $result = collect(['a', 'b', 'c',])
            ->implode('-')
        ;

        $this->assertEquals(
            'a-b-c',
            $result
        );
    }

    public function testAssocCase()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->implode('-')
        ;

        $this->assertEquals(
            '1-2-3',
            $result
        );
    }

    public function testNestAssocRidiculousCase()
    {
        $result = collect([
            collect(['a' => 1, 'b' => 2, 'c' => 3,]),
            collect(['a' => 4, 'b' => 5, 'c' => 6,]),
            collect(['a' => 7, 'b' => 8, 'c' => 9,]),
        ])
            ->implode('-')
        ;

        $this->assertEquals(
            '',
            $result
        );
    }

    public function testNestAssocCaseWithKey()
    {
        $resultOfPluckImplode = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
            ['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->pluck('a')
            ->implode('-')
        ;

        $resultOfImplode = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
            ['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->implode('a', '-')
        ;

        $this->assertEquals(
            $resultOfPluckImplode,
            $resultOfImplode
        );
        $this->assertEquals(
            '1-4-7',
            $resultOfImplode
        );
    }

    public function testObjectArrayCaseWithKey()
    {
        $resultOfPluckImplode = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
            (object)['a' => 7, 'b' => 8, 'c' => 9,],
        ])
        ->pluck('a')
        ->implode('-')
        ;

        $resultOfImplode = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
            (object)['a' => 7, 'b' => 8, 'c' => 9,],
        ])
            ->implode('a', '-')
        ;

        $this->assertEquals(
            $resultOfPluckImplode,
            $resultOfImplode
        );
        $this->assertEquals(
            '1-4-7',
            $resultOfImplode
        );
    }
}
