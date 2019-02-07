<?php
namespace App;
use PHPUnit\Framework\TestCase;

class AquariumTest extends TestCase
{
    /** @test */
    public function itIsOfAquariumType()
    {
        $aquarium = new Aquarium(100, 2.0);
        $this->assertTrue($aquarium instanceof Aquarium);
    }
}