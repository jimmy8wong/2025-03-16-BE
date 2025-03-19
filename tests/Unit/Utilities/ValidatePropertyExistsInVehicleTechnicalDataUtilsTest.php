<?php 

namespace App\Tests\Unit\Utilies;

use App\Entity\Make;
use App\Entity\Vehicle;
use App\Utilities\ValidatePropertyExistsInVehicleTechnicalDataUtils;
use PHPUnit\Framework\TestCase;

class ValidatePropertyExistsInVehicleTechnicalDataUtilsTest extends TestCase
{
    private ValidatePropertyExistsInVehicleTechnicalDataUtils $util;
    private Vehicle $vehicle;

    protected function setUp(): void
    {
        $this->util = new ValidatePropertyExistsInVehicleTechnicalDataUtils();

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

    public function testPropertyExists()
    {
        $result = $this->util->__invoke($this->vehicle, 'Power');
        $this->assertTrue($result);

        $result = $this->util->__invoke($this->vehicle, 'Top Speed');
        $this->assertTrue($result);

        $result = $this->util->__invoke($this->vehicle, 'Engine Size');
        $this->assertTrue($result);
    }

    public function testPropertyDoesNotExist()
    {
        $result = $this->util->__invoke($this->vehicle, 'power');
        $this->assertFalse($result);

        $result = $this->util->__invoke($this->vehicle, 'TopSpeed');
        $this->assertFalse($result);

        $result = $this->util->__invoke($this->vehicle, 'Engine Size ');
        $this->assertFalse($result);
    }
}