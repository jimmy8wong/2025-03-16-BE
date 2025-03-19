<?php

namespace App\Utilities;

use App\Entity\Vehicle;

readonly final class SetVehicleTechnicalDataUtils
{
    public function __invoke(Vehicle $vehicle, array $newProperty): Vehicle
    {
        $newTechData = array_merge($vehicle->getTechnicalData(), $newProperty);
        $vehicle->setTechnicalData($newTechData);

        return $vehicle;
    }
}