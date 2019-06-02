<?php

namespace Tests\Unit\Decision;

use Tests\TestCase;

class EveryTest extends TestCase
{
    public function testEmptyCase()
    {
        $result = collect()
            ->every(function ($value) {
                return false;
            })
        ;

        // empty collection returns always true.
        $this->assertTrue($result);
    }

    public function testRidiculousAssocTruthyCase()
    {
        $result = collect(['a' => 1, 'b' => true, 'c' => 'abc',])
            ->every('a', null)
        ;

        // if elements is pramary, value is always evaluated as `null`
        $this->assertTrue($result);
    }

    public function testRidiculousAssocFalsyCase()
    {
        $result = collect(['a' => 1, 'a' => 1, 'a' => 1,])
            ->every('a', 1)
        ;

        $this->assertFalse($result);
    }

    public function testNestAssocTruthyCaseWithKey()
    {
        $resultOfEvery = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 1, 'b' => 5, 'c' => 6,],
        ])
            ->every('a', 1)
        ;

        $resultOfWhereNotInIsEmpty = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 1, 'b' => 5, 'c' => 6,],
        ])
            ->whereNotIn('a', 1)
            ->isEmpty()
        ;

        $this->assertEquals(
            $resultOfWhereNotInIsEmpty,
            $resultOfEvery
        );
        $this->assertTrue($resultOfEvery);
    }

    public function testNestAssocFalsyCaseWithKey()
    {
        $resultOfEvery = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->every('a', 1)
        ;

        $resultOfWhereNotInIsEmpty = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->whereNotIn('a', 1)
            ->isEmpty()
        ;

        $this->assertEquals(
            $resultOfWhereNotInIsEmpty,
            $resultOfEvery
        );
        $this->assertFalse($resultOfEvery);
    }

    public function testObjectArrayTruthyCaseWithKey()
    {
        $resultOfEvery = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 1, 'b' => 5, 'c' => 6,],
        ])
            ->every('a', 1)
        ;

        $resultOfWhereNotInIsEmpty = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 1, 'b' => 5, 'c' => 6,],
        ])
            ->whereNotIn('a', 1)
            ->isEmpty()
        ;

        $this->assertEquals(
            $resultOfWhereNotInIsEmpty,
            $resultOfEvery
        );
        $this->assertTrue($resultOfEvery);
    }

    public function testObjectArrayFalsyCaseWithKey()
    {
        $resultOfEvery = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->every('a', 1)
        ;

        $resultOfWhereNotInIsEmpty = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->whereNotIn('a', 1)
            ->isEmpty()
        ;

        $this->assertEquals(
            $resultOfWhereNotInIsEmpty,
            $resultOfEvery
        );
        $this->assertFalse($resultOfEvery);
    }

    public function testNestAssocTruthyCaseWithOperator()
    {
        $resultOfEvery = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->every('a', '<', 5)
        ;

        $resultOfInvertWhereIsEmpty = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->where('a', '>=', 5)
            ->isEmpty()
        ;

        $this->assertEquals(
            $resultOfInvertWhereIsEmpty,
            $resultOfEvery
        );
        $this->assertTrue($resultOfEvery);
    }

    public function testNestAssocFalsyCaseWithOperator()
    {
        $resultOfEvery = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->every('a', '<', 4)
        ;

        $resultOfInvertWhereIsEmpty = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->where('a', '>=', 4)
            ->isEmpty()
        ;

        $this->assertEquals(
            $resultOfInvertWhereIsEmpty,
            $resultOfEvery
        );
        $this->assertFalse($resultOfEvery);
    }

    public function testObjectArrayTruthyCaseWithOperator()
    {
        $resultOfEvery = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->every('a', '<', 5)
        ;

        $resultOfInvertWhereIsEmpty = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->where('a', '>=', 5)
            ->isEmpty()
        ;

        $this->assertEquals(
            $resultOfInvertWhereIsEmpty,
            $resultOfEvery
        );
        $this->assertTrue($resultOfEvery);
    }

    public function testObjectArrayFalsyCaseWithOperator()
    {
        $resultOfEvery = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->every('a', '<', 4)
        ;

        $resultOfInvertWhereIsEmpty = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->where('a', '>=', 4)
            ->isEmpty()
        ;

        $this->assertEquals(
            $resultOfInvertWhereIsEmpty,
            $resultOfEvery
        );
        $this->assertFalse($resultOfEvery);
    }

    public function testClosureTruthyCase()
    {
        $resultOfEvery = collect([1, 2, 3,])
            ->every(function ($value) {
                return $value < 4;
            })
        ;
        $resultOfRejectIsEmpty = collect([1, 2, 3,])
            ->reject(function ($value) {
                return $value < 4;
            })
            ->isEmpty()
        ;

        $this->assertEquals(
            $resultOfRejectIsEmpty,
            $resultOfEvery
        );
        $this->assertTrue($resultOfEvery);
    }

    public function testClosureFalsyCase()
    {
        $resultOfEvery = collect([1, 2, 3,])
            ->every(function ($value, $index) {
                return $index > 2;
            })
        ;

        $resultOfRejectIsEmpty = collect([1, 2, 3,])
            ->reject(function ($value, $index) {
                return $index > 2;
            })
            ->isEmpty()
        ;

        $this->assertEquals(
            $resultOfRejectIsEmpty,
            $resultOfEvery
        );
        $this->assertFalse($resultOfEvery);
    }
}
