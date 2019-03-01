<?php
namespace App;
use PHPUnit\Framework\TestCase;

class FloatRangeTest extends TestCase
{
    /**
     * @test 
     * @dataProvider intersectTrueProvider
     */
    public function itIntersectsWith($min1, $max1, $min2, $max2) {
        $range = new FloatRange($min1, $max1);
        $otherRange = new FloatRange($min2, $max2);
        $this->assertTrue($range->intersectsWith($otherRange));
    }

    public function intersectTrueProvider()
    {
        return [
            [6, 7, 6.2, 6.8],
            [6, 7, 6.9, 7],
        ];
    }

    /**
     * @test 
     * @dataProvider intersectFalseProvider
     */
    public function itDoesNotIntersect($min3, $max3, $min4, $max4) {
        $range = new FloatRange($min3, $max3);
        $otherRange = new FloatRange($min4, $max4);
        $this->assertFalse($range->intersectsWith($otherRange));
    }

    public function intersectFalseProvider()
    {
        return [
            [6, 7, 5, 5.9],
            [6, 9, 9.1, 10],
        ];
    }
}