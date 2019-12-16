<?php
declare(strict_types=1);

namespace AppBundle\Repository;

use AppBundle\Entity\Aquarium;
use AppBundle\Entity\FishInAquarium;
use AppBundle\Entity\FishType;
use AppBundle\Entity\FloatRange;
use AppBundle\Entity\Gadget\WaterAbsorbGadget;
use AppBundle\Entity\Gadget\WaterExchangeGadget;
use AppBundle\Entity\Gadget\WaterMeasuringGadget;

/**
 * Single repository to handle all data. 
 * Not split up into the appropriate sub-repositories to avoid duplication while all data is hard-coded.
 * Once an actual storage solution is implemented, e.g. database, this should be split up.
 */
class AquariumRepository {

    private $fishTypes;

    private $aquariums;

    public function __construct() {
        $angelfish = new FishType('Angelfish', 'peaceful', new FloatRange(6.5, 7.1), 5);
        $fancyGuppy = new FishType('Fancy Guppy', 'peaceful', new FloatRange(6.8, 7.8), 3);
        $jewelCichlid = new FishType('Jewel Cichlid', 'aggressive', new FloatRange(6.5, 7.5), 7.5);
        $kribensis = new FishType('Kribensis', 'aggressive', new FloatRange(6, 8), 8);
        $lionheadCichlid = new FishType('Lionhead Cichlid', 'aggressive', new FloatRange(6.6, 8), 7.5);
        $cherryBarb = new FishType('Cherry Barb', 'aggressive', new FloatRange(6, 6.5), 10);
    
        $this->fishTypes = [
            $angelfish, 
            $fancyGuppy, 
            $jewelCichlid, 
            $kribensis, 
            $lionheadCichlid, 
            $cherryBarb
        ];

        $aquarium1 = new Aquarium(100, 400);
        $aquarium1->addFish($angelfish, 10);
    
        $aquarium2 = new Aquarium(60, 250);
        $aquarium2->addFish($jewelCichlid, 5);
        $aquarium2->addFish($kribensis, 10);
        $aquarium2->addFish($lionheadCichlid, 2);
    
        $aquarium3 = new Aquarium(25, 90);
        $aquarium3->addFish($fancyGuppy, 3);
    
        $this->aquariums = [
            $aquarium1, 
            $aquarium2, 
            $aquarium3
        ];

        $measuringCup = new WaterMeasuringGadget('Measuring cup');
        $lengthOfVinylTubing =  new WaterExchangeGadget('Length of vinyl tubing');
        $chamois = new WaterAbsorbGadget('Chamois');
    
        $gadgets = [
            $measuringCup, 
            $lengthOfVinylTubing, 
            $chamois
        ];
    
        $aquarium1->addGadget($gadgets[rand(0, count($gadgets)-1)]);
        $aquarium2->addGadget($gadgets[rand(0, count($gadgets)-1)]);
        $aquarium3->addGadget($gadgets[rand(0, count($gadgets)-1)]);
    }

    public function getFishTypes() {
        return $this->fishTypes;
    }

    public function getAquariums() {
        return $this->aquariums;
    }
}