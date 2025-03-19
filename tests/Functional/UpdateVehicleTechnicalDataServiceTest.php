<?php

namespace App\Tests\Functional;

use App\Entity\Vehicle;
use App\Service\UpdateVehicleTechnicalDataService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Process\Process;

class UpdateVehicleTechnicalDataServiceTest extends KernelTestCase
{
    private UpdateVehicleTechnicalDataService $service;
    public EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $runMigrations = new Process(['php', 'bin/console', 'doctrine:migrations:migrate']);
        $runMigrations->run();

        $loadFixtures = new Process(['php', 'bin/console', 'doctrine:fixtures:load', '--env=test', '--append']);
        $loadFixtures->run();
    }

    public function testUpdateSuccess()
    {
        // check current Power tech data value
        $vehicle = $this->entityManager->getRepository(Vehicle::class)
            ->findOneBy(['slug' => 'ford-focus-hatchback']);

        $this->assertEquals('123 bhp', $vehicle->getTechnicalData()['Power']);

        // update Power value and check it got updated
        $request = new Request([], [], [], [], [], [], json_encode([
            'Power' => '88 bhp'
        ]));

        $service = new UpdateVehicleTechnicalDataService($vehicle, $request, $this->entityManager);
        $vehicle = $service->update();

        $this->assertEquals('88 bhp', $vehicle->getTechnicalData()['Power']);

        // update Power value again and check it got updated
        $request = new Request([], [], [], [], [], [], json_encode([
            'Power' => '13 bhp'
        ]));

        $service = new UpdateVehicleTechnicalDataService($vehicle, $request, $this->entityManager);
        $vehicle = $service->update();

        $this->assertNotEquals('131 bhp', $vehicle->getTechnicalData()['Power']);
        $this->assertEquals('13 bhp', $vehicle->getTechnicalData()['Power']);
    }

    public function testRequestException()
    {
        $vehicle = $this->entityManager->getRepository(Vehicle::class)
            ->findOneBy(['slug' => 'ford-focus-hatchback']);

        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage('Invalid Request object');

        $request = new Request([], [], [], [], [], [], 'test invalid content');

        $service = new UpdateVehicleTechnicalDataService($vehicle, $request, $this->entityManager);
        $vehicle = $service->update();
    }

    public function testInvalidPropertyException()
    {
        $vehicle = $this->entityManager->getRepository(Vehicle::class)
            ->findOneBy(['slug' => 'ford-focus-hatchback']);

        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage('Property not found');

        $request = new Request([], [], [], [], [], [], json_encode([
            'Length' => '5 metres'
        ]));

        $service = new UpdateVehicleTechnicalDataService($vehicle, $request, $this->entityManager);
        $vehicle = $service->update();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $runMigrations = new Process(['php', 'bin/console', 'doctrine:migrations:migrate', '--env=test', 'first', '--no-interaction']);
        $runMigrations->run();
    }
}