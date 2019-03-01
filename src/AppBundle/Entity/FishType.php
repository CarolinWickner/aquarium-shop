<?php
declare(strict_types=1);

namespace AppBundle\Entity;

class FishType implements \JsonSerializable {
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

