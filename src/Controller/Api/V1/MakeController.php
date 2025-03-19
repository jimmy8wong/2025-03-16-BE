<?php

namespace App\Controller\Api\V1;

use App\Entity\Make;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1/makes', name: 'api_v1_makes_')]
final class MakeController extends AbstractController {
    #[Route('/{vehicleTypeSlug}', name: 'get', methods: ['GET'])]
    public function vehicleTypes(string $vehicleTypeSlug, EntityManagerInterface $em): JsonResponse
    {
        $makes = $em->getRepository(Make::class)->findByVehicleTypeSlug($vehicleTypeSlug);

        return $this->json($makes, $status = 200, [], [
            'groups' => ['make:list']
        ]);
    }
}
