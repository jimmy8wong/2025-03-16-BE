<?php

namespace App\Tests\Controller\Api\V1;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Process\Process;

class VehicleControllerTest extends WebTestCase
{
    protected function setUp(): void
    {
        // load up a fresh database
        $runMigrations = new Process(['php', 'bin/console', 'doctrine:migrations:migrate']);
        $runMigrations->run();

        $loadFixtures = new Process(['php', 'bin/console', 'doctrine:fixtures:load', '--env=test', '--append']);
        $loadFixtures->run();
    }

    public function testGetFordFocusResponse(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/v1/vehicles/ford-focus-hatchback');

        $response = $client->getResponse();
        $content = $response->getContent();
        $contentAsArray = json_decode($client->getResponse()->getContent(), true);
        
        $this->assertJson($content);
        $this->assertIsArray($contentAsArray['technicalData']);
        $this->assertEquals('123 bhp', $contentAsArray['technicalData']['Power']);
        $this->assertEquals('1296kg', $contentAsArray['technicalData']['Weight']);
    }

    public function testGetMercedesEqaResponse(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/v1/vehicles/mercedes-eqa-crossover');

        $response = $client->getResponse();
        $content = $response->getContent();
        $contentAsArray = json_decode($client->getResponse()->getContent(), true);
        
        $this->assertJson($content);
        $this->assertIsArray($contentAsArray['technicalData']);
        $this->assertEquals('70.5 kWh', $contentAsArray['technicalData']['Battery capacity']);
        $this->assertEquals('346 miles', $contentAsArray['technicalData']['Battery range']);
    }

    public function testPatchFordFocusResponse(): void
    {
        $client = static::createClient();
        $client->jsonRequest(
            'PATCH', 
            '/api/v1/vehicles/ford-focus-hatchback/technical-data',
            [
                'Power' => '8 bhp'
            ]
        );

        $response = $client->getResponse();
        $content = $response->getContent();
        $contentAsArray = json_decode($client->getResponse()->getContent(), true);
        
        $this->assertJson($content);
        $this->assertIsArray($contentAsArray['technicalData']);
        $this->assertEquals('8 bhp', $contentAsArray['technicalData']['Power']);
        $this->assertEquals('1296kg', $contentAsArray['technicalData']['Weight']);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $runMigrations = new Process(['php', 'bin/console', 'doctrine:migrations:migrate', '--env=test', 'first', '--no-interaction']);
        $runMigrations->run();
    }
}