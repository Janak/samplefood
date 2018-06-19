<?php

namespace App\Controller;

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
    public function index(Request $request, ProductionCapacityRepository $productionCapacityRepository, $dataValidator)
    {
        if ($production_capacities = $request->getContent()) {
            $production_capacities = json_decode($production_capacities, true);
        }

        // validate submitted data
        $errors = $dataValidator->validate($production_capacities);

        if (count($errors) > 0) {
            return $errors;
        }

        $result = $productionCapacityRepository->saveBulkData($production_capacities['productionCapacities']);

        return new JsonResponse($result, 200);
    }
}
