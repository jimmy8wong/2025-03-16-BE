<?php

namespace App\DataFixtures;

use App\Entity\Make;
use App\Entity\Vehicle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class VehicleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $fordFocus = new Vehicle();
        $fordFocus->setName('Focus');
        $fordFocus->setSlug('ford-focus');
        $fordFocus->setTechnicalData([
            'Power' => '123 bhp',
            'Top Speed' => '121 mph',
            'Torque' => '170 Nm, 125 ft-lb',
            'CO2 Emissions' => '134 g/km',
            'Euro Emissions Standard' => 6,
            'Fuel Capacity' => '52 litres',
            'Weight' => '1296kg',
            'Engine Size' => '999cc',
            'Fuel Type' => 'Petrol'
        ]);
        $fordFocus->setMake($this->getReference(MakeFixtures::MAKE_FORD_REFERENCE, Make::class));
        $manager->persist($fordFocus);

        $mercedesEqa = new Vehicle();
        $mercedesEqa->setName('EQA');
        $mercedesEqa->setSlug('mercedes-eqa');
        $mercedesEqa->setTechnicalData([
            'Battery capacity' => '70.5 kWh',
            'Transmission' => 'Automatic',
            'CO2 Emissions' => '0 g/km',
            'Top speed' => '99 mph',
            'Battery range' => '346 miles'
        ]);
        $mercedesEqa->setMake($this->getReference(MakeFixtures::MAKE_MERCEDES_REFERENCE, Make::class));
        $manager->persist($mercedesEqa);

        $mercedesAClass = new Vehicle();
        $mercedesAClass->setName('A-Class');
        $mercedesAClass->setSlug('mercedes-a-class');
        $mercedesAClass->setTechnicalData([
            'Power' => '220 bhp',
            'Top Speed' => '155 mph',
            'Torque' => '350 Nm, 258 ft-lb',
            'CO2 Emissions' => '155 g/km',
            'Euro Emissions Standard' => 6,
            'Fuel Capacity' => '51 litres',
            'Weight' => '1455kg',
            'Engine Size' => '1991cc',
            'Fuel Type' => 'Petrol'
        ]);
        $mercedesAClass->setMake($this->getReference(MakeFixtures::MAKE_MERCEDES_REFERENCE, Make::class));
        $manager->persist($mercedesAClass);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            MakeFixtures::class,
        ];
    }
}
