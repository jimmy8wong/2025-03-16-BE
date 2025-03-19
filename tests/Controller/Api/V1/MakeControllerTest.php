<?php

namespace App\Tests\Controller\Api\V1;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Process\Process;

class MakeControllerTest extends WebTestCase
{
    protected function setUp(): void
    {
        // load up a fresh database
        $runMigrations = new Process(['php', 'bin/console', 'doctrine:migrations:migrate']);
        $runMigrations->run();

        $loadFixtures = new Process(['php', 'bin/console', 'doctrine:fixtures:load', '--env=test', '--append']);
        $loadFixtures->run();
    }

    public function testMultipleHatchbacksResponse(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/v1/makes/hatchback');

        $response = $client->getResponse();
        $content = $response->getContent();
        $contentAsArray = json_decode($client->getResponse()->getContent(), true);
        
        $this->assertJson($content);
        $this->assertCount(2, $contentAsArray);
        $this->assertEquals('ford', $contentAsArray[0]['slug']);
        $this->assertEquals('mercedes', $contentAsArray[1]['slug']);
    }

    public function testSingleCrossoverResponse(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/v1/makes/crossover');

        $response = $client->getResponse();
        $content = $response->getContent();
        $contentAsArray = json_decode($client->getResponse()->getContent(), true);
        
        $this->assertJson($content);
        $this->assertCount(1, $contentAsArray);
        $this->assertEquals('mercedes', $contentAsArray[0]['slug']);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $runMigrations = new Process(['php', 'bin/console', 'doctrine:migrations:migrate', '--env=test', 'first', '--no-interaction']);
        $runMigrations->run();
    }
}