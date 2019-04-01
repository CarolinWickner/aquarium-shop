<?php
declare(strict_types=1);

namespace AppBundle\GadgetTests;

use AppBundle\Entity\Gadget\Gadget;
use AppBundle\Entity\Gadget\WaterExchangeGadget;
use PHPUnit\Framework\TestCase;

class WaterExchangeGadgetTest extends TestCase
{
    /** @test */
    public function itIsOfGadgetType() {
        $waterExchangeGadget = new WaterExchangeGadget('Test');
        $this->assertTrue($waterExchangeGadget instanceof Gadget);
    }
}