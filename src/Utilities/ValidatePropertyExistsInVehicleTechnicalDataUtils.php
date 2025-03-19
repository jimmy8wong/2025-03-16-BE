<?php

namespace App\Utilities;

use App\Entity\Vehicle;

readonly final class ValidatePropertyExistsInVehicleTechnicalDataUtils
{
    public function __invoke(Vehicle $vehicle, string $propertyName): bool
    {
        return array_key_exists($propertyName, $vehicle->getTechnicalData());
    }
}