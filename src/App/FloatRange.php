<?php
declare(strict_types=1);

namespace App;

class FloatRange {
    private $minValue;

    private $maxValue;

    public function __construct(float $minValue, float $maxValue) {
        $this->minValue = $minValue;
        $this->maxValue = $maxValue;
    }

    public function intersectsWith(FloatRange $otherRange) : bool {
        $result = ($this->maxValue < $otherRange->minValue) || ($otherRange->maxValue < $this->minValue);
        return !$result;
    }
}