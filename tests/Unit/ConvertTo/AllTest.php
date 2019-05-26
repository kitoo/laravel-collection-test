<?php

namespace Tests\Unit\ConvertTo;

use Illuminate\Support\Collection;
use Tests\TestCase;

class AllTest extends TestCase
{
    public function testSimpleCase()
    {
        $array = [1, 2, 3,];
        $result = collect($array)
            ->all()
        ;

        $this->assertEquals(
            $array,
            $result
        );
    }

    public function testNestArrayCase()
    {
        $array = [[1, 2, 3,], ['a', 'b', 'c',],];
        $result = collect($array)
            ->all()
        ;

        $this->assertEquals(
            $array,
            $result
        );
    }

    public function testNestCollectionCase()
    {
        $array = [collect([1, 2, 3,]), collect(['a', 'b', 'c',]),];
        $result = collect($array)
            ->all()
        ;

        $this->assertEquals(
            $array,
            $result
        );
        $this->assertNotEquals(
            [[1, 2, 3,], ['a', 'b', 'c',],],
            $result
        );
    }
}
