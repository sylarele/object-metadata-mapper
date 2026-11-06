<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Contracts;

use BackedEnum;
use stdClass;

/**
 * @phpstan-type DescriptionType array<string, string>
 */
interface MapperInterface
{
    /**
     * @return array<array-key, mixed>|BackedEnum|bool|int|stdClass|string|null
     */
    public function fake(): null|array|BackedEnum|bool|int|stdClass|string;

    /**
     * @return DescriptionType
     */
    public function descriptions(): array;
}
