<?php
declare(strict_types=1);

class FishType implements JsonSerializable {
    private $name;

    private $character;

    private $phRange;

    private $cost;

    public function __construct(string $name, string $character, FloatRange $phRange, float $cost) {
        $this->name = $name;
        $this->character = $character;
        $this->phRange = $phRange;
        $this->cost = $cost;
    }

    public function getCost() : float {
        return $this->cost;
    }

    public function canLiveTogether(FishType $fishType) : bool {
        $result = $this->phRange->intersectsWith($fishType->phRange) && ($this->character === $fishType->character);
        return $result;
    }

    public function jsonSerialize() {
        $json = [
            'name' => $this->name,
        ];
        return $json;
    }
}

class FloatRange {
    private $minValue;

    private $maxValue;

    public function __construct(float $minValue, float $maxValue) {
        $this->minValue = $minValue;
        $this->maxValue = $maxValue;
    }

    public function intersectsWith(FloatRange $otherRange) {
        $result = ($this->maxValue < $otherRange->minValue) || ($otherRange->maxValue < $this->minValue);
        return !$result;
    }
}

class FishInAquarium implements JsonSerializable {
    private $fishType;

    private $amount;

    public function __construct(FishType $fishType, int $amount) {
        $this->fishType = $fishType;
        $this->amount = $amount;
    }

    public function getAmount() : int {
        return $this->amount;
    }

    public function getFishType() : FishType {
        return $this->fishType;
    }

    public function jsonSerialize() {
        $json = [
            'fishType' => $this->fishType,
            'amount' => $this->amount,
        ];
        return $json;
    }
}

abstract class Gadget {
    private $name;

    public function __construct(string $name) {
        $this->name = $name;
    }
}

class WaterMeasuringGadget extends Gadget {
}

class WaterExchangeGadget extends Gadget {
}

class WaterAbsorbGadget extends Gadget {
}

class Aquarium implements JsonSerializable {
    private $capacity;

    private $cost;

    /**
    * @var FishInAquarium[]
    */
    private $fishInAquarium;

    /**
    * @var Gadget[]
    */
    private $gadgets;

    public function __construct(int $capacity, float $cost) {
        $this->capacity = $capacity;
        $this->cost = $cost;
        $this->fishInAquarium = array();
        $this->gadgets = array();
    }

    public function addFish(FishType $fishType, int $amount) : void {
        $this->fishInAquarium[] = new FishInAquarium($fishType, $amount);
    }

    public function addGadget(Gadget $gadget) : void {
        $this->gadgets[] = $gadget;
    }

    public function getSalePrice() : float {
        $costOfAquarium = $this->cost;
        $totalCostOfFish = 0;
        foreach($this->fishInAquarium as $singleFishType) {
            $totalCostOfFish += $singleFishType->getFishType()->getCost() * $singleFishType->getAmount();
        }

        $price = ($totalCostOfFish * 1.5) + ($costOfAquarium * 1.3);
        $salePrice = ceil($price / 10) * 10 - 0.01;
        return $salePrice;
    }

    public function jsonSerialize() {
        $json = [
            'fishInAquarium' => $this->fishInAquarium,
            'salePrize' => $this->getSalePrice(),
        ];
        return $json;
    }
}

#1st task: Preconfigured aquarium with fish
$angelfish = new FishType('Angelfish', 'peaceful', new FloatRange(6.5, 7.1), 5);
$fancyGuppy = new FishType('Fancy Guppy', 'peaceful', new FloatRange(6.8, 7.8), 3);
$jewelCichlid = new FishType('Jewel Cichlid', 'aggressive', new FloatRange(6.5, 7.5), 7.5);
$kribensis = new FishType('Kribensis', 'aggressive', new FloatRange(6, 8), 8);
$lionheadCichlid = new FishType('Lionhead Cichlid', 'aggressive', new FloatRange(6.6, 8), 7.5);
$cherryBarb = new FishType('Cherry Barb', 'aggressive', new FloatRange(6, 6.5), 10);

$fishTypes = array ($angelfish, $fancyGuppy, $jewelCichlid, $kribensis, $lionheadCichlid, $cherryBarb);

$aquarium1 = new Aquarium(100, 400);
$aquarium1->addFish($angelfish, 10);

$aquarium2 = new Aquarium(60, 250);
$aquarium2->addFish($jewelCichlid, 5);
$aquarium2->addFish($kribensis, 10);
$aquarium2->addFish($lionheadCichlid, 2);

$aquarium3 = new Aquarium(25, 90);
$aquarium3->addFish($fancyGuppy, 3);

$aquariums = array($aquarium1, $aquarium2, $aquarium3);

#2nd task: Digital advisor that tells if fish can live together
$angelfish->canLiveTogether($fancyGuppy);
$angelfish->canLiveTogether($jewelCichlid);
$lionheadCichlid->canLiveTogether($cherryBarb);

#3rd task: Sale prizes of aquariums
$aquarium1->getSalePrice();
$aquarium2->getSalePrice();
$aquarium3->getSalePrice();

#4th task: Adding random gadgets
$measuringCup = new WaterMeasuringGadget('Measuring cup');
$lengthOfVinylTubing =  new WaterExchangeGadget('Length of vinyl tubing');
$chamois = new WaterAbsorbGadget('Chamois');

$gadgets = array($measuringCup, $lengthOfVinylTubing, $chamois);

$aquarium1->addGadget($gadgets[rand(0, count($gadgets)-1)]);
$aquarium2->addGadget($gadgets[rand(0, count($gadgets)-1)]);
$aquarium3->addGadget($gadgets[rand(0, count($gadgets)-1)]);

#5th task: JSON to list all fish types and aquariums with fish and prices
$return_array = array(
    'fishTypes' => $fishTypes,
    'aquariums' => $aquariums,
);

header('Content-Type: application/json');
echo json_encode($return_array);