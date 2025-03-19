<?php

namespace App\Service;

use App\Entity\Vehicle;
use App\Utilities\GetRequestContentUtils;
use App\Utilities\SetVehicleTechnicalDataUtils;
use App\Utilities\ValidatePropertyExistsInVehicleTechnicalDataUtils;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;

readonly final class UpdateVehicleTechnicalDataService 
{
    private const EXCEPTION_MESSAGE_PROPERTY_NOT_FOUND = 'Property not found';

    public function __construct(
        public Vehicle $vehicle,
        public Request $request,
        public EntityManagerInterface $entityManager
    ) {

    }

    public function update(): Vehicle
    {
        try {
            $requestContent = new GetRequestContentUtils();
            $newTechnicalData = $requestContent($this->request);
        } catch (BadRequestException $e) {
            throw $e;
        }

        $vehicleTechnicalDataPropertyCheck = new ValidatePropertyExistsInVehicleTechnicalDataUtils();
        $propertyExists = $vehicleTechnicalDataPropertyCheck($this->vehicle, key($newTechnicalData));

        if (!$propertyExists) {
            throw new BadRequestException(self::EXCEPTION_MESSAGE_PROPERTY_NOT_FOUND);
        }

        try {
            $vehicleTechDataUtil = new SetVehicleTechnicalDataUtils();
            $vehicle = $vehicleTechDataUtil($this->vehicle, $newTechnicalData);
        } catch (Exception $e) {
            throw $e;
        }

        try {
            $this->entityManager->getRepository(Vehicle::class)->update($vehicle, true);
        } catch (Exception $e) {
            throw $e;
        }

        return $vehicle;
    }
}