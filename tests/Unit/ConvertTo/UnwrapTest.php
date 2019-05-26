<?php

namespace Tests\Unit\ConvertTo;

use Illuminate\Support\Collection;
use Tests\TestCase;

class UnwrapTest extends TestCase
{
    public function testArrayCase()
    {
        $array = [1, 2, 3,];
        $result = Collection::unwrap($array);

        $this->assertEquals(
            $array,
            $result
        );
    }

    public function testCollectionCase()
    {
        $array = [1, 2, 3,];
        $result = Collection::unwrap(collect($array));

        $this->assertEquals(
            $array,
            $result
        );
    }

    public function testNestArrayCase()
    {
        $array = [[1, 2, 3,], ['a', 'b', 'c',],];
        $result = Collection::unwrap(collect($array));

        $this->assertEquals(
            $array,
            $result
        );
    }

    public function testNestCollectionCase()
    {
        $array = [collect([1, 2, 3,]), collect(['a', 'b', 'c',]),];
        $result = Collection::unwrap(collect($array));

        $this->assertEquals(
            $array,
            $result
        );
        $this->assertNotEquals(
            [[1, 2, 3,], ['a', 'b', 'c',],],
            $result
        );
    }

    public function testSingleCase()
    {
        $result = Collection::unwrap('abc');

        $this->assertEquals(
            'abc',
            $result
        );
    }

}
