<?php
declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Repository\AquariumRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ShopController {
    private $repository;

    public function __construct(AquariumRepository $repository) {
        $this->repository = $repository;
    }

    /**
    * @Route("/index")
    * @Method("GET")
    */
    public function indexAction() {
        $return_array = [
            'fishTypes' => $this->repository->getFishTypes(),
            'aquariums' => $this->repository->getAquariums(),
        ];
        return new JsonResponse($return_array);
    }
}


