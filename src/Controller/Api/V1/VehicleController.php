<?php

namespace App\Controller\Api\V1;

use App\Entity\Vehicle;
use App\Service\UpdateVehicleTechnicalDataService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;

#[Route('/api/v1/vehicles', name: 'api_v1_vehicles_')]
final class VehicleController extends AbstractController {
    /**
     * Retrieve all the technical details of a specific vehicle
     */
    #[Route('/{slug}', name: 'detail_get', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Returns all the technical details of a specific vehicle',
        content: new OA\JsonContent(
            ref: new Model(type: Vehicle::class, groups: ['vehicle:details'])
        )
    )]
    #[OA\Tag(name: 'vehicles')]
    public function showVehicle(
        #[MapEntity(mapping:['slug'=>'slug'])] Vehicle $vehicle
    ): JsonResponse {
        return $this->json($vehicle, $status = 200, [], [
            'groups' => ['vehicle:details']
        ]);
    }

    /**
     * Update a specific technical parameter of a vehicle
     */
    #[Route('/{slug}/technical-data', name: 'technical_data_patch', methods: ['PATCH'])]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: "object",
            example: [
                "Power" => "71 bhp"
            ],
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'Vehicle updated successfully, returns vehicle details',
        content: new OA\JsonContent(
            ref: new Model(type: Vehicle::class, groups: ['vehicle:details'])
        )
    )]
    #[OA\Response(
        response: 400,
        description: 'Returned when an invalid technical data property is submitted'
    )]
    #[OA\Tag(name: 'vehicles')]
    public function updateVehicleTechnicalData(
        #[MapEntity(mapping:['slug'=>'slug'])] Vehicle $vehicle, 
        Request $request,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $service = new UpdateVehicleTechnicalDataService($vehicle, $request, $entityManager);
        $vehicle = $service->update();

        return $this->json($vehicle, $status = 200, [], [
            'groups' => ['vehicle:details']
        ]);
    }
}
