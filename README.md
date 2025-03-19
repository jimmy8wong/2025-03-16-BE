# Vehicles API

## Overview
API to fetch and update technical data about vehicles.

## Assumptions
### Database Design
- `Make` entity is the vehicle brand (Ford, Mercedes etc)
- `VehicleType` are things like hatchbacks and SUVs
- `Vehicle` stores the Technical Data as an array using the `JSON` data type
- Vehicle Technical Data is assumed to be different for each vehicle which is why it's stored in the DB as a json object.
- Considered using the `Observation Pattern` rather then a simple json object but the pattern is overly complex and is not really suited for a relational database.

### Endpoints
Endpoints were created based on the exact wording in the instructions.
```
1. Endpoint for retrieving all the vehicle makers which are manufacturing a specific type of vehicle
```
Only return a list of makers (Ford, Mecedes etc) which have at least 1 vehicle matching the requested type (hatchback, SUV etc).

```
2. Endpoint for retrieving all the technical details of a specific vehicle
```
Get vehicle data. Certain fields like the createdAt and uopdatedAt timestamps are hidden. These can be easily exposed if required.

```
3. Endpoint for updating a specific technical parameter of a vehicle
```
This only updates ONE technical data property.

### Other Endpoints for Consideration
Other endpoints critical for a standard REST API platform would be:
- `GET+POST+PATCH+DELETE /api/v1/makes` Create a new vehicle Make and list/update/delete existing Make
- `GET+POST+PATCH+DELETE /api/v1/vehicles` Create a new vehicle and list/update/delete existing vehicle
- `GET+POST+PATCH+DELETE /api/v1/types` Create a new vehicle type and list/update/delete existing types

## Installation
### Prerequisites
- PHP (version 8.2)
- Composer (version 2)

### Dependencies
The application is based on `symfony/skeleton@7.2` and requires the following dependencies:
- `symfony/orm-pack`
- `symfony/maker-bundle`
- `symfony/validator`
- `orm-fixtures`
- `symfony/test-pack`
- `symfony/serializer-pack`
- `symfony/process`

## Testing
This project includes:
- **Unit Tests**: Verify individual methods.
- **Functional Tests**: TODO
- **Application Tests**: Verifies controller endpoints.

Run all tests using:
```bash
composer test
```

Run just the unit tests using:
```bash
composer test:unit
```

Run just the functional tests using:
```bash
composer test:functional
```

Run just the application tests using:
```bash
composer test:application
```