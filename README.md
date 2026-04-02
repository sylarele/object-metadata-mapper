# object-metadata-mapper

[![License](https://img.shields.io/github/license/sylarele/object-metadata-mapper.svg)](https://github.com/sylarele/object-metadata-mapper/blob/main/LICENSE "LICENSE")
![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/sylarele/object-metadata-mapper/php)
[![Packagist Downloads](https://img.shields.io/packagist/dm/sylarele/object-metadata-mapper)](https://packagist.org/packages/sylarele/object-metadata-mapper "Packagist")

A PHP library for describing metadata and fake data on classes via **PHP attributes**,
then querying them through a generic service.

## Installation

```bash
composer require sylarele/object-metadata-mapper
```

## How it works

**Annotate a class** with `Mapper` attributes to describe its structure and fake values.
**Implement `MetadataService`** to resolve which class corresponds to a key (a `BackedEnum`).
**Call `findByKey()`** to get a `MetadataDto` containing the descriptions and fake data.

## Annotating a class

Each attribute takes a `key` (field name) and an optional `description`.

```php
use Sylarele\ObjectMetadataMapper\Attributes\ObjectMapper;
use Sylarele\ObjectMetadataMapper\Attributes\FullNameMapper;
use Sylarele\ObjectMetadataMapper\Attributes\EmailMapper;
use Sylarele\ObjectMetadataMapper\Attributes\PhoneMapper;
use Sylarele\ObjectMetadataMapper\Attributes\ObjectEachMapper;
use Sylarele\ObjectMetadataMapper\Attributes\AddressMapper;

#[ObjectMapper(
    'user',
    new FullNameMapper('fullname'),
    new PhoneMapper('phone'),
    new EmailMapper('email'),
    new ObjectEachMapper(
        'addresses',
        2,
        new AddressMapper('address'),
    )
)]
class UserObject
{
}
```

## Implementing MetadataService

Create a `BackedEnum` as a key, then extend `MetadataService` by implementing `getClassName()` to map each enum value to an annotated class.

```php
// The key enum
enum UserType: string
{
    case Profile = 'profile';
}
```

```php
use Sylarele\ObjectMetadataMapper\MetadataService;

/**
 * @extends MetadataService<UserType>
 */
class UserMetadataService extends MetadataService
{
    protected function getClassName(BackedEnum $keyTemplate): string
    {
        return match ($keyTemplate) {
            UserType::Profile => UserObject::class,
        };
    }
}
```

## Using the service

```php
$service = new UserMetadataService();
$dto = $service->findByKey(UserType::Profile);

// Structured fake data
$dto->fake;

// Field descriptions
$dto->description;
```

### `MetadataDto` structure

| Property       | Type                    | Description                  |
|----------------|-------------------------|------------------------------|
| `$template`    | `BackedEnum`            | The key used                 |
| `$description` | `array<string, string>` | Mapping `key => description` |
| `$fake`        | `array<string, mixed>`  | Mapping `key => fake value`  |

## Available attributes

| Attribute               | Description                               |
|-------------------------|-------------------------------------------|
| `StringMapper`          | Short string (max 60 characters)          |
| `TextMapper`            | Long text                                 |
| `IntegerMapper`         | Integer                                   |
| `BooleanMapper`         | Boolean                                   |
| `DateMapper`            | Date (`Y-m-d`)                            |
| `DateTimeMapper`        | Date and time                             |
| `TimeMapper`            | Time                                      |
| `EmailMapper`           | Email address                             |
| `PhoneMapper`           | Phone number                              |
| `UrlMapper`             | URL                                       |
| `ImageMapper`           | Image URL                                 |
| `FirstNameMapper`       | First name                                |
| `LastNameMapper`        | Last name                                 |
| `FullNameMapper`        | Full name                                 |
| `AddressMapper`         | Postal address                            |
| `AmountMapper`          | Numeric amount                            |
| `EnumValueMapper`       | Enum value                                |
| `ReferenceMapper`       | Reference (UUID / ID)                     |
| `ArrayMapper`           | Array of values                           |
| `StrictArrayMapper`     | Strictly typed array                      |
| `ArrayEachMapper`       | Array with N occurrences of a mapper      |
| `StrictArrayEachMapper` | Strict array with N occurrences           |
| `ObjectMapper`          | Object composed of sub-mappers            |
| `ObjectEachMapper`      | Array of N composed objects               |
