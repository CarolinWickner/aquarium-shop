<?php
declare(strict_types=1);

namespace AppBundle\GadgetTests;

use AppBundle\Entity\Gadget\Gadget;
use AppBundle\Entity\Gadget\WaterMeasuringGadget;
use PHPUnit\Framework\TestCase;

class WaterMeasuringGadgetTest extends TestCase
{
    /** @test */
    public function itIsOfGadgetType() {
        $waterMeasuringGadget = new WaterMeasuringGadget('Test');
        $this->assertTrue($waterMeasuringGadget instanceof Gadget);
    }
}