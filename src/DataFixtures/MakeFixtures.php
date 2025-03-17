<?php

namespace App\DataFixtures;

use App\Entity\Make;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MakeFixtures extends Fixture
{
    public const MAKE_FORD_REFERENCE = 'ford';
    public const MAKE_MERCEDES_REFERENCE = 'mercedes';

    public function load(ObjectManager $manager): void
    {
        $ford = new Make();
        $ford->setName('Ford');
        $ford->setSlug('ford');
        $manager->persist($ford);

        $mercedes = new Make();
        $mercedes->setName('Mercedes');
        $mercedes->setSlug('mercedes');
        $manager->persist($mercedes);

        $manager->flush();

        $this->addReference(self::MAKE_FORD_REFERENCE, $ford);
        $this->addReference(self::MAKE_MERCEDES_REFERENCE, $mercedes);
    }
}
