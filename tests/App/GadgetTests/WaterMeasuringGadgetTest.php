<?php
namespace App\Gadget;
use PHPUnit\Framework\TestCase;

class WaterMeasuringGadgetTest extends TestCase
{
    /** @test */
    public function itIsOfGadgetType() {
        $waterMeasuringGadget = new WaterMeasuringGadget('Test');
        $this->assertTrue($waterMeasuringGadget instanceof Gadget);
    }
}