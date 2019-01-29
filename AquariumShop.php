<?php
declare(strict_types=1);

class FishType {
    private $name;

    public function __construct(string $name) {
        $this->name = $name;
    }
}

$angelfish = new FishType('Angelfish');
$fancyGuppy = new FishType('Fancy Guppy');
$jewelCichlid = new FishType('Jewel Cichlid');
$kribensis = new FishType('Kribensis');
$lionheadCichlid = new Fishtype('Lionhead Cichlid');

class FishInAquarium {
    private $fishType;

    private $amount;

    public function __construct(FishType $fishType, int $amount) {
        $this->fishType = $fishType;
        $this->amount = $amount;
    }
}

class Aquarium {
    /**
    * @var int 
    */
    private $capacity;

    /**
    * @var FishInAquarium[]
    */
    private $fishInAquarium = array();

    public function addFish(FishType $fishType, int $amount) {
        $this->fishInAquarium[] = new FishInAquarium($fishType, $amount);
    }

    public function setCapacity($capacity) {
        $this->capacity = $capacity;
    }
}

$aquarium1 = new Aquarium();
$aquarium1->setCapacity(100);
$aquarium1->addFish($angelfish, 10);
var_dump($aquarium1);

$aquarium2 = new Aquarium();
$aquarium2->setCapacity(60);
$aquarium2->addFish($jewelCichlid, 5);
$aquarium2->addFish($kribensis, 10);
$aquarium2->addFish($lionheadCichlid, 2);
var_dump($aquarium2);

$aquarium3 = new Aquarium();
$aquarium3->setCapacity(25);
$aquarium3->addFish($fancyGuppy, 3);
var_dump($aquarium3);
