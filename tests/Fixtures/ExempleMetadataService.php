<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Tests\Fixtures;

use BackedEnum;
use InvalidArgumentException;
use Sylarele\ObjectMetadataMapper\MetadataService;
use Sylarele\ObjectMetadataMapper\Tests\Fixtures\Enums\ExampleType;
use Sylarele\ObjectMetadataMapper\Tests\Fixtures\Objects\BarObject;

/**
 * @extends MetadataService<ExampleType>
 */
class ExempleMetadataService extends MetadataService
{
    /**
     * @param ExampleType $keyTemplate
     */
    protected function getClassName(BackedEnum $keyTemplate): string
    {
        return match ($keyTemplate) {
            ExampleType::Foo => BarObject::class,
        };
    }
}
