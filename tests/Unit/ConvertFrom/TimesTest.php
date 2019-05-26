<?php

namespace Tests\Unit\ConvertFrom;

use Illuminate\Support\Collection;
use Tests\TestCase;

class TimesTest extends TestCase
{
    public function testSimpleCase()
    {
        $result = Collection::times(5, function($value) {
            return "1-{$value}";
        });

        $this->assertEquals(
            ['1-1', '1-2', '1-3', '1-4', '1-5',],
            $result->all()
        );
    }

    public function testCaseWithoutClosure()
    {
        $resultOfRange = range(1, 5);
        $resultOfTimes = Collection::times(5);

        $this->assertEquals(
            $resultOfRange,
            $resultOfTimes->all()
        );

        $this->assertEquals(
            [1, 2, 3, 4, 5,],
            $resultOfTimes->all()
        );
    }
}
