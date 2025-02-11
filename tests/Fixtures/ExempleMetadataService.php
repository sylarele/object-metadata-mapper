<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Tests\Fixtures;

use Sylarele\ObjectMetadataMapper\MetadataService;
use Sylarele\ObjectMetadataMapper\Tests\Fixtures\Enums\ExampleType;
use Sylarele\ObjectMetadataMapper\Tests\Fixtures\Objects\BarObject;
use UnitEnum;

class ExempleMetadataService extends MetadataService
{
    protected function getClassName(UnitEnum $keyTemplate): string
    {
        return match ($keyTemplate) {
            ExampleType::Foo => BarObject::class,
            default => throw new \InvalidArgumentException(),
        };
    }
}
