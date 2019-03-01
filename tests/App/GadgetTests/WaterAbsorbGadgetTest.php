<?php
namespace App\Gadget;
use PHPUnit\Framework\TestCase;

class WaterAbsorbGadgetTest extends TestCase
{
    /** @test */
    public function itIsOfGadgetType() {
        $waterAbsorbGadget = new WaterAbsorbGadget('Test');
        $this->assertTrue($waterAbsorbGadget instanceof Gadget);
    }
}