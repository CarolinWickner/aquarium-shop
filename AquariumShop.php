<?php
declare(strict_types=1);

class FishType implements JsonSerializable {
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

    public function getCost() : float{
        return $this->cost;
    }

    public function canLiveTogether(FishType $fishType) : bool {
        $phRange1 = range($this->phMin, $this->phMax, $step = 0.1);
        $phRange2 = range($fishType->phMin, $fishType->phMax, $step =0.1);
        $overlapCount = count(array_intersect($phRange1, $phRange2));

        if (($overlapCount > 0) && ($this->character == $fishType->character)) {
            return true;
        }
        return false;
    }

    public function jsonSerialize() {
        $json = array (
            'name' => $this->name,
        );
        return $json;
    }
}

class FishInAquarium implements JsonSerializable {
    private $fishType;

    private $amount;

    public function __construct(FishType $fishType, int $amount) {
        $this->fishType = $fishType;
        $this->amount = $amount;
    }

    public function getAmount() : int{
        return $this->amount;
    }

    public function getFishType() : FishType {
        return $this->fishType;
    }

    public function jsonSerialize() {
        $json = array (
            'fishType' => $this->fishType,
            'amount' => $this->amount,
        );
        return $json;
    }
}

class Gadget {
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
        $json = array (
            'fishInAquarium' => $this->fishInAquarium,
            'salePrize' => $this->getSalePrice(),
        );
        return $json;
    }
}

#1st Task: Preconfigured aquarium with fish
$angelfish = new FishType('Angelfish', 'peaceful', 6.5, 7.1, 5);
$fancyGuppy = new FishType('Fancy Guppy', 'peaceful', 6.8, 7.8, 3);
$jewelCichlid = new FishType('Jewel Cichlid', 'aggressive', 6.5, 7.5, 7.5);
$kribensis = new FishType('Kribensis', 'aggressive', 6, 8, 8);
$lionheadCichlid = new FishType('Lionhead Cichlid', 'aggressive', 6.6, 8, 7.5);
$cherryBarb = new FishType('Cherry Barb', 'aggressive', 6, 6.5, 10);

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
var_dump($angelfish->canLiveTogether($fancyGuppy));
var_dump($angelfish->canLiveTogether($jewelCichlid));
var_dump($lionheadCichlid->canLiveTogether($cherryBarb));

#3rd task: Sale prizes of aquariums
var_dump($aquarium1->getSalePrice());
var_dump($aquarium2->getSalePrice());
var_dump($aquarium3->getSalePrice());

#4th task: Adding random gadgets
$measuringCup = new WaterMeasuringGadget('Measuring cup');
$lengthOfVinylTubing =  new WaterExchangeGadget('Length of vinyl tubing');
$chamois = new WaterAbsorbGadget('Chamois');

$gadgets = array($measuringCup, $lengthOfVinylTubing, $chamois);

$aquarium1->addGadget($gadgets[rand(0, count($gadgets)-1)]);
$aquarium2->addGadget($gadgets[rand(0, count($gadgets)-1)]);
$aquarium3->addGadget($gadgets[rand(0, count($gadgets)-1)]);

#5th task: JSON to list all fish types and aquariums with fish and prices
echo json_encode($fishTypes);
echo json_encode($aquariums);