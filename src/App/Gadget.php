<?php
declare(strict_types=1);

namespace App;

abstract class Gadget {
    private $name;

    public function __construct(string $name) {
        $this->name = $name;
    }
}