<?php 

namespace App\Tests\Unit\Utilies;

use App\Entity\Make;
use App\Entity\Vehicle;
use PHPUnit\Framework\TestCase;

class SetVehicleTechnicalDataUtilsTest extends TestCase
{
    private SetVehicleTechnicalDataUtils $util;
    private Vehicle $vehicle;

    protected function setUp(): void
    {
        $this->util = new SetVehicleTechnicalDataUtils();

        $make = new Make();
        $make->setName('Test Make');
        $make->setSlug('test-make');

        $this->vehicle = new Vehicle();
        $this->vehicle->setName('Test Vehicle');
        $this->vehicle->setSlug('test-vehicle');
        $this->vehicle->setTechnicalData([
            'Power' => '123 bhp',
            'Top Speed' => '112 mph',
            'Engine Size' => '876cc'
        ]);
        $this->vehicle->setMake($make);
    }

    public function testTechnicalData()
    {
        $result = $this->util->__invoke($this->vehicle, ['Power' => '12 bhp']);
        $this->assertEquals(
            [
                'Power' => '12 bhp',
                'Top Speed' => '112 mph',
                'Engine Size' => '876cc'
            ],
            $result->getTechnicalData()
        );

        $result = $this->util->__invoke($this->vehicle, ['Top Speed' => '236 mph']);
        $this->assertEquals(
            [
                'Power' => '12 bhp',
                'Top Speed' => '236 mph',
                'Engine Size' => '876cc'
            ],
            $result->getTechnicalData()
        );
    }
}