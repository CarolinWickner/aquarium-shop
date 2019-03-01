<?php
namespace App\Gadget;
use PHPUnit\Framework\TestCase;

class WaterExchangeGadgetTest extends TestCase
{
    /** @test */
    public function itIsOfGadgetType() {
        $waterExchangeGadget = new WaterExchangeGadget('Test');
        $this->assertTrue($waterExchangeGadget instanceof Gadget);
    }
}