<?php

namespace App\Controller;

use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\ProductionCapacity;
use App\Repository\ProductionCapacityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductCapacityController extends Controller
{
    /**
     * @Route("/api/production_capacities_bulk", name="product_capacity_bulk", methods={"POST"})
     */
    public function index(Request $request, ProductionCapacityRepository $productionCapacityRepository)
    {

        if ($production_capacities = $request->getContent()) {
            $production_capacities = json_decode($production_capacities, true);
        }

        $errors = $productionCapacityRepository->validateCollection($production_capacities);

        if (count($errors) > 0) {
            return new JsonResponse($errors);
        }

        $result = $productionCapacityRepository->saveBulkData($production_capacities);

        return new JsonResponse($result, 200);
    }
}
