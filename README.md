# Vehicles API

## Overview
API to fetch and update technical data about vehicles.

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

Run just unit tests using:
```bash
composer test:unit
```

Run just application tests using:
```bash
composer test:application
```