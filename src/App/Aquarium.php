<?php
declare(strict_types=1);

namespace App;

use App\Gadget\Gadget;

class Aquarium implements \JsonSerializable {
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

    public function getFishInAquarium() : array {
        return $this->fishInAquarium; 
    }

    public function addFish(FishType $fishType, int $amount) : void {
        foreach($this->fishInAquarium as $existingFishInAquarium) {
            if (!$fishType->canLiveTogether($existingFishInAquarium->getFishType())) {
                throw new \InvalidArgumentException('Fish type cannot live in this aquarium.');
            }
        }
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
            'salePrice' => $this->getSalePrice(),
        ];
        return $json;
    }
}