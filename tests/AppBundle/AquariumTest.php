<?php
declare(strict_types=1);

namespace AppBundle;

use AppBundle\Entity\Aquarium;
use AppBundle\Entity\FishInAquarium;
use AppBundle\Entity\FishType;
use PHPUnit\Framework\TestCase;

class AquariumTest extends TestCase
{
    private $compatibleFishType;
    private $uncompatibleFishType;

    public function setUp() : void {
        $this->compatibleFishType = $this->createMock(FishType::class);
        $this->compatibleFishType->method('canLiveTogether')->willReturn(true);
        $this->uncompatibleFishType = $this->createMock(FishType::class);
        $this->uncompatibleFishType->method('canLiveTogether')->willReturn(false);
    }

    /** @test */
    public function testExceptionWhenAddingUncompatibleFish()
    {
        $aquarium = new Aquarium(100, 500);
        // adding any fish to an empty aquarium should not throw an exception
        $aquarium->addFish($this->compatibleFishType, 1);
        // adding a fishtype that is not compatible with an already present one, throws an exception
        $this->expectException(\InvalidArgumentException::class);
        $aquarium->addFish($this->uncompatibleFishType, 1);
    }

    /** @test */
    public function testAddingCompatibleFish()
    {
        $aquarium = new Aquarium(100, 500);
        $aquarium->addFish($this->compatibleFishType, 1);
        $aquarium->addFish($this->compatibleFishType, 2);

        // assert that the aquarium now contains all the added fish
        $this->assertEquals(2, count($aquarium->getFishInAquarium()));
    }
}