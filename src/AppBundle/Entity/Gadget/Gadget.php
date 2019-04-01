<?php
declare(strict_types=1);

namespace AppBundle\Entity\Gadget;

abstract class Gadget {
    private $name;

    public function __construct(string $name) {
        $this->name = $name;
    }
}