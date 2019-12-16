<?php
declare(strict_types=1);

namespace AppBundle\Entity;

class FishInAquarium implements \JsonSerializable {
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