<?php
declare(strict_types=1);

class FishType {
    private $name;

    private $character;

    private $phMin;

    private $phMax;

    public function __construct(string $name, string $character, float $phMin, float $phMax) {
        $this->name = $name;
        $this->character = $character;
        $this->phMin = $phMin;
        $this->phMax = $phMax;
    }

    public function canLiveTogether(FishType $fishType) {
        $phRange1 = range($this->phMin, $this->phMax, $step = 0.1);
        $phRange2 = range($fishType->phMin, $fishType->phMax, $step =0.1);
        $overlapCount = count(array_intersect($phRange1, $phRange2));

        if (($overlapCount > 0) && ($this->character == $fishType->character)) {
            return true;
        }
        return false;
    }
}

$angelfish = new FishType('Angelfish', 'peaceful', 6.5, 7.1);
$fancyGuppy = new FishType('Fancy Guppy', 'peaceful', 6.8, 7.8);
$jewelCichlid = new FishType('Jewel Cichlid', 'aggressive', 6.5, 7.5);
$kribensis = new FishType('Kribensis', 'aggressive', 6, 8);
$lionheadCichlid = new Fishtype('Lionhead Cichlid', 'aggressive', 6.6, 8);
$cherryBarb = new Fishtype('Cherry Barb', 'aggressive', 6, 6.5);

class FishInAquarium {
    private $fishType;

    private $amount;

    public function __construct(FishType $fishType, int $amount) {
        $this->fishType = $fishType;
        $this->amount = $amount;
    }
}

class Aquarium {
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

$aquarium2 = new Aquarium();
$aquarium2->setCapacity(60);
$aquarium2->addFish($jewelCichlid, 5);
$aquarium2->addFish($kribensis, 10);
$aquarium2->addFish($lionheadCichlid, 2);

$aquarium3 = new Aquarium();
$aquarium3->setCapacity(25);
$aquarium3->addFish($fancyGuppy, 3);

var_dump($angelfish->canLiveTogether($fancyGuppy));
var_dump($angelfish->canLiveTogether($jewelCichlid));
var_dump($lionheadCichlid->canLiveTogether($cherryBarb));
