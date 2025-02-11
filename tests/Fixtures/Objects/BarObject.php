<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Tests\Fixtures\Objects;

use Sylarele\ObjectMetadataMapper\Attributes\AddressMapper;
use Sylarele\ObjectMetadataMapper\Attributes\EmailMapper;
use Sylarele\ObjectMetadataMapper\Attributes\FullNameMapper;
use Sylarele\ObjectMetadataMapper\Attributes\ObjectEachMapper;
use Sylarele\ObjectMetadataMapper\Attributes\ObjectMapper;
use Sylarele\ObjectMetadataMapper\Attributes\PhoneMapper;

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
class BarObject
{
}
