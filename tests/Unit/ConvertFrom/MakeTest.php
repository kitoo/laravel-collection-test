<?php

namespace Tests\Unit\ConvertFrom;

use Illuminate\Support\Collection;
use Tests\TestCase;

class MakeTest extends TestCase
{
    public function testArrayCase()
    {
        $result = Collection::make([1, 2, 3,]);

        $this->assertEquals(
            collect([1, 2, 3,]),
            $result
        );
    }

    public function testCollectionCase()
    {
        $collection = collect([1, 2, 3,]);
        $result = Collection::make($collection);

        $this->assertEquals(
            $collection,
            $result
        );
    }

    public function testSingleCase()
    {
        $result = Collection::make('abc');

        $this->assertEquals(
            collect(['abc',]),
            $result
        );
    }

}
