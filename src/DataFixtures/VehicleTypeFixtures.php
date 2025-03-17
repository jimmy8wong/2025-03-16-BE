<?php

namespace App\DataFixtures;

use App\Entity\VehicleType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VehicleTypeFixtures extends Fixture
{
    public const VEHICLE_TYPE_HATCHBACK_REFERENCE = 'hatchback';
    public const VEHICLE_TYPE_CROSSOVER_REFERENCE = 'crossover';

    public function load(ObjectManager $manager): void
    {
        $hatchback = new VehicleType();
        $hatchback->setName('Hatchback');
        $hatchback->setSlug('hatchback');
        $manager->persist($hatchback);

        $crossover = new VehicleType();
        $crossover->setName('Crossover');
        $crossover->setSlug('crossover');
        $manager->persist($crossover);

        $manager->flush();

        $this->addReference(self::VEHICLE_TYPE_HATCHBACK_REFERENCE, $hatchback);
        $this->addReference(self::VEHICLE_TYPE_CROSSOVER_REFERENCE, $crossover);
    }
}
