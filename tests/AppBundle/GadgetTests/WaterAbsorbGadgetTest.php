<?php
declare(strict_types=1);

namespace AppBundle\GadgetTests;

use AppBundle\Entity\Gadget\Gadget;
use AppBundle\Entity\Gadget\WaterAbsorbGadget;
use PHPUnit\Framework\TestCase;

class WaterAbsorbGadgetTest extends TestCase
{
    /** @test */
    public function itIsOfGadgetType() {
        $waterAbsorbGadget = new WaterAbsorbGadget('Test');
        $this->assertTrue($waterAbsorbGadget instanceof Gadget);
    }
}