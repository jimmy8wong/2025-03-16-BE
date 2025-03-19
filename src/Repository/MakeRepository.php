<?php

namespace App\Repository;

use App\Entity\Make;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Make>
 */
class MakeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Make::class);
    }

    /**
     * Returns all Makes with at least one vehicle matching the vehicle type slug
     *
     * @param string $vehicleTypeSlug
     * @return array
     */
    public function findByVehicleTypeSlug(string $vehicleTypeSlug): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT m
            FROM App\Entity\Make m
            INNER JOIN m.vehicles v
            INNER JOIN v.type t
            WHERE t.slug = :slug'
        )->setParameter('slug', $vehicleTypeSlug);

        return $query->getResult();
    }
}
