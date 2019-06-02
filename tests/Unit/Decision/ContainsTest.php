<?php

namespace Tests\Unit\Decision;

use Tests\TestCase;

class ContainsTest extends TestCase
{
    public function testSimpleTruthyCase()
    {
        $result = collect([1, 2, 3,])
            ->contains(1)
        ;

        $this->assertTrue($result);
    }

    public function testSimpleFalsyCase()
    {
        $result = collect([1, 2, 3,])
            ->contains(0)
        ;

        $this->assertFalse($result);
    }

    public function testAssocTruthyCase()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->contains(1)
        ;

        $this->assertTrue($result);
    }

    public function testAssocFalsyCase()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->contains(4)
        ;

        $this->assertFalse($result);
    }

    public function testAssocCaseWithKey()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->contains('a', 1)
        ;

        // it is unsuitable to use 2nd param for assoc
        $this->assertFalse($result);
    }

    public function testNestAssocTruthyCaseWithKey()
    {
        $resultOfContains = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->contains('a', 1)
        ;

        $resultOfWhereIsNotEmpty = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->where('a', 1)
            ->isNotEmpty()
        ;

        $this->assertEquals(
            $resultOfWhereIsNotEmpty,
            $resultOfContains
        );
        $this->assertTrue($resultOfContains);
    }

    public function testNestAssocFalsyCaseWithKey()
    {
        $resultOfContains = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->contains('a', 2)
        ;

        $resultOfWhereIsNotEmpty = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->where('a', 2)
            ->isNotEmpty()
        ;

        $this->assertEquals(
            $resultOfWhereIsNotEmpty,
            $resultOfContains
        );

        $this->assertFalse($resultOfContains);
    }

    public function testNestAssocRidiculousCase()
    {
        $result = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->contains(2)
        ;

        $this->assertFalse($result);
    }

    public function testObjectArrayTruthyCaseWithKey()
    {
        $resultOfContains = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->contains('a', 1)
        ;

        $resultOfWhereIsNotEmpty = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->where('a', 1)
            ->isNotEmpty()
        ;

        $this->assertEquals(
            $resultOfWhereIsNotEmpty,
            $resultOfContains
        );
        $this->assertTrue($resultOfContains);
    }

    public function testObjectArrayFalsyCaseWithKey()
    {
        $resultOfContains = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->contains('a', 2)
        ;

        $resultOfWhereIsNotEmpty = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->where('a', 2)
            ->isNotEmpty()
        ;

        $this->assertEquals(
            $resultOfWhereIsNotEmpty,
            $resultOfContains
        );

        $this->assertFalse($resultOfContains);
    }

    public function testNestAssocTruthyCaseWithOperator()
    {
        $resultOfContains = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->contains('a', '<', 5)
        ;

        $resultOfWhereIsNotEmpty = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->where('a', '<', 5)
            ->isNotEmpty()
        ;

        $this->assertEquals(
            $resultOfWhereIsNotEmpty,
            $resultOfContains
        );
        $this->assertTrue($resultOfContains);
    }

    public function testNestAssocFalsyCaseWithOperator()
    {
        $resultOfContains = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->contains('a', '>', 4)
        ;

        $resultOfWhereIsNotEmpty = collect([
            ['a' => 1, 'b' => 2, 'c' => 3,],
            ['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->where('a', '>', 4)
            ->isNotEmpty()
        ;

        $this->assertEquals(
            $resultOfWhereIsNotEmpty,
            $resultOfContains
        );
        $this->assertFalse($resultOfContains);
    }


    public function testObjectArrayTruthyCaseWithOperator()
    {
        $resultOfContains = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->contains('a', '<', 5)
        ;

        $resultOfWhereIsNotEmpty = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->where('a', '<', 5)
            ->isNotEmpty()
        ;

        $this->assertEquals(
            $resultOfWhereIsNotEmpty,
            $resultOfContains
        );
        $this->assertTrue($resultOfContains);
    }

    public function testObjectArrayFalsyCaseWithOperator()
    {
        $resultOfContains = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->contains('a', '>', 4)
        ;

        $resultOfWhereIsNotEmpty = collect([
            (object)['a' => 1, 'b' => 2, 'c' => 3,],
            (object)['a' => 4, 'b' => 5, 'c' => 6,],
        ])
            ->where('a', '>', 4)
            ->isNotEmpty()
        ;

        $this->assertEquals(
            $resultOfWhereIsNotEmpty,
            $resultOfContains
        );
        $this->assertFalse($resultOfContains);
    }

    public function testClosureTruthyCase()
    {
        $resultOfContains = collect([1, 2, 3,])
            ->contains(function ($value) {
                return $value % 3 == 0;
            })
        ;

        $resultOfFilterIsNotEmpty = collect([1, 2, 3,])
            ->filter(function ($value) {
                return $value % 3 == 0;
            })
            ->isNotEmpty()
        ;

        $this->assertEquals(
            $resultOfFilterIsNotEmpty,
            $resultOfContains
        );
        $this->assertTrue($resultOfContains);
    }

    public function testClosureFalsyCase()
    {
        $resultOfContains = collect([1, 2, 3,])
            ->contains(function ($value, $index) {
                return $index !==0 && $index % 3 == 0;
            })
        ;

        $resultOfFilterIsNotEmpty = collect([1, 2, 3,])
            ->filter(function ($value, $index) {
                return $index !==0 && $index % 3 == 0;
            })
            ->isNotEmpty()
        ;

        $this->assertEquals(
            $resultOfFilterIsNotEmpty,
            $resultOfContains
        );
        $this->assertFalse($resultOfContains);
    }
}
