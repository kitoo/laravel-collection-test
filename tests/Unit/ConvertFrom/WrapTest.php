<?php

namespace Tests\Unit\ConvertFrom;

use Illuminate\Support\Collection;
use Tests\TestCase;

class WrapTest extends TestCase
{
    public function testArrayCase()
    {
        $result = Collection::wrap([1, 2, 3,]);

        $this->assertEquals(
            collect([1, 2, 3,]),
            $result
        );
    }

    public function testCollectionCase()
    {
        $collection = collect([1, 2, 3,]);
        $result = Collection::wrap($collection);

        $this->assertEquals(
            $collection,
            $result
        );
    }

    public function testSingleCase()
    {
        $result = Collection::wrap('abc');

        $this->assertEquals(
            collect(['abc',]),
            $result
        );
    }

}
