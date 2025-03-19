<?php

namespace App\Controller\Api\V1;

use App\Entity\Vehicle;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1/vehicles', name: 'api_v1_vehicles_')]
final class VehicleController extends AbstractController {
    #[Route('/{slug}', name: 'detail_get', methods: ['GET'])]
    public function showVehicle(
        #[MapEntity(mapping:['slug'=>'slug'])] Vehicle $vehicle
    ): JsonResponse {
        return $this->json($vehicle, $status = 200, [], [
            'groups' => ['vehicle:details']
        ]);
    }

    #[Route('/{slug}/technical-data', name: 'technical_data_patch', methods: ['PATCH'])]
    public function updateVehicleTechnicalData(
        #[MapEntity(mapping:['slug'=>'slug'])] Vehicle $vehicle, 
        Request $request
    ): JsonResponse {
        // TODO implement service

        return $this->json($vehicle, $status = 200, [], [
            'groups' => ['vehicle:details']
        ]);
    }
}
