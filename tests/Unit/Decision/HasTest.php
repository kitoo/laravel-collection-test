<?php

namespace Tests\Unit\Decision;

use Tests\TestCase;

class HasTest extends TestCase
{
    public function testSimpleTruthyCase()
    {
        $resultOfKeysContains = collect(['a', 'b', 'c',])
            ->keys()
            ->contains(2)
        ;
        $resultOfHas = collect(['a', 'b', 'c',])
            ->has(2)
        ;

        $this->assertEquals(
            $resultOfKeysContains,
            $resultOfHas
        );
        $this->assertTrue($resultOfHas);
    }

    public function testSimpleFalsyCase()
    {
        $resultOfKeysContains = collect(['a', 'b', 'c',])
            ->keys()
            ->contains(3)
        ;
        $resultOfHas = collect(['a', 'b', 'c',])
            ->has(3)
        ;

        $this->assertEquals(
            $resultOfKeysContains,
            $resultOfHas
        );
        $this->assertFalse($resultOfHas);
    }

    public function testAssocTruthyCase()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->has('a')
        ;

        $this->assertTrue($result);
    }

    public function testAssocFalsyCase()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->has(1)
        ;

        $this->assertFalse($result);
    }

    public function testAssocTruthyCaseWithMultipleParams()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->has('a', 'c')
        ;

        $this->assertTrue($result);
    }

    public function testAssocFalsyCaseWithMultipleParams()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->has('a', 'z')
        ;

        // Only when all params is included in collection, result is true.
        $this->assertFalse($result);
    }

    public function testAssocTruthyCaseWithArrayParam()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->has(['a', 'c',])
        ;

        $this->assertTrue($result);
    }

    public function testAssocFalsyCaseWithArrayParam()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->has(['a', 'z',])
        ;

        // Only when all params is included in collection, result is true.
        $this->assertFalse($result);
    }

}
