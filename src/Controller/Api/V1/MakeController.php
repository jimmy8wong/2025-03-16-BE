<?php

namespace App\Controller\Api\V1;

use App\Entity\Make;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;

#[Route('/api/v1/makes', name: 'api_v1_makes_')]
final class MakeController extends AbstractController {
    /**
     * Retrieve all vehicle makers which are manufacturing a specific type of vehicle
     */
    #[Route('/{vehicleTypeSlug}', name: 'get', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Returns all Makes with the requested Type',
        content: new OA\JsonContent(
            ref: new Model(type: Make::class, groups: ['make:list'])
        )
    )]
    #[OA\Tag(name: 'makes')]
    public function vehicleTypes(string $vehicleTypeSlug, EntityManagerInterface $em): JsonResponse
    {
        $makes = $em->getRepository(Make::class)->findByVehicleTypeSlug($vehicleTypeSlug);

        return $this->json($makes, $status = 200, [], [
            'groups' => ['make:list']
        ]);
    }
}
