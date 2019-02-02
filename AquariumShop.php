<?php
declare(strict_types=1);

class FishType {
    private $name;

    private $character;

    private $phMin;

    private $phMax;

    private $cost;

    public function __construct(string $name, string $character, float $phMin, float $phMax, float $cost) {
        $this->name = $name;
        $this->character = $character;
        $this->phMin = $phMin;
        $this->phMax = $phMax;
        $this->cost = $cost;
    }

    public function getCost() {
        return $this->cost;
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

$angelfish = new FishType('Angelfish', 'peaceful', 6.5, 7.1, 5);
$fancyGuppy = new FishType('Fancy Guppy', 'peaceful', 6.8, 7.8, 3);
$jewelCichlid = new FishType('Jewel Cichlid', 'aggressive', 6.5, 7.5, 7.5);
$kribensis = new FishType('Kribensis', 'aggressive', 6, 8, 8);
$lionheadCichlid = new FishType('Lionhead Cichlid', 'aggressive', 6.6, 8, 7.5);
$cherryBarb = new FishType('Cherry Barb', 'aggressive', 6, 6.5, 10);

class FishInAquarium {
    private $fishType;

    private $amount;

    public function __construct(FishType $fishType, int $amount) {
        $this->fishType = $fishType;
        $this->amount = $amount;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function getFishType() {
        return $this->fishType;
    }
}

class Aquarium {
    private $capacity;

    private $cost;

    /**
    * @var FishInAquarium[]
    */
    private $fishInAquarium;

    public function __construct(int $capacity, float $cost) {
        $this->capacity = $capacity;
        $this->cost = $cost;
        $this->fishInAquarium = array();
    }

    public function addFish(FishType $fishType, int $amount) {
        $this->fishInAquarium[] = new FishInAquarium($fishType, $amount);
    }

    public function getCost() {
        return $this->cost;
    }

    public function getSalePrice() {
        $costOfAquarium = $this->getCost();
        $totalCostOfFish = 0;
        foreach($this->fishInAquarium as $singleFishType) {
            $totalCostOfFish += $singleFishType->getFishType()->getCost() * $singleFishType->getAmount();
        }

        $price = ($totalCostOfFish * 1.5) + ($costOfAquarium * 1.3);
        $salePrice = ceil($price / 10) * 10 - 0.01;
        return $salePrice;
    }
}

$aquarium1 = new Aquarium(100, 400);
$aquarium1->addFish($angelfish, 10);

$aquarium2 = new Aquarium(60, 250);
$aquarium2->addFish($jewelCichlid, 5);
$aquarium2->addFish($kribensis, 10);
$aquarium2->addFish($lionheadCichlid, 2);

$aquarium3 = new Aquarium(25, 90);
$aquarium3->addFish($fancyGuppy, 3);

var_dump($angelfish->canLiveTogether($fancyGuppy));
var_dump($angelfish->canLiveTogether($jewelCichlid));
var_dump($lionheadCichlid->canLiveTogether($cherryBarb));

var_dump($aquarium1->getSalePrice());
var_dump($aquarium2->getSalePrice());
var_dump($aquarium3->getSalePrice());