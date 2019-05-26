<?php

namespace Tests\Unit\ConvertTo;

use Illuminate\Support\Collection;
use Tests\TestCase;

class ToJsonTest extends TestCase
{
    public function testSimpleCase()
    {
        $result = collect([1, 2, 3,])
            ->toJson()
        ;

        $this->assertEquals(
            '[1,2,3]',
            $result
        );
    }

    public function testAssocCase()
    {
        $result = collect(['a' => 1, 'b' => 2, 'c' => 3,])
            ->toJson()
        ;

        $this->assertEquals(
            '{"a":1,"b":2,"c":3}',
            $result
        );
    }

    public function testNestArrayCase()
    {
        $result = collect([[1, 2, 3,], ['a', 'b', 'c',],])
            ->toJson()
        ;

        $this->assertEquals(
            '[[1,2,3],["a","b","c"]]',
            $result
        );
    }

    public function testNestCollectionCase()
    {
        $result = collect([collect([1, 2, 3,]), collect(['a', 'b', 'c',]),])
            ->toJson()
        ;

        $this->assertEquals(
            '[[1,2,3],["a","b","c"]]',
            $result
        );
    }
}
