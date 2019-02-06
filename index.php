<?php
declare(strict_types=1);

require_once './vendor/autoload.php';

use App\FishType;
use App\FloatRange;
use App\FishInAquarium;
use App\WaterMeasuringGadget;
use App\WaterExchangeGadget;
use App\WaterAbsorbGadget;
use App\Aquarium;

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