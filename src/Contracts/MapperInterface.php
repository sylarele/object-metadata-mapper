<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Contracts;

use stdClass;

/**
 * @phpstan-type DescriptionType array<string, string>
 */
interface MapperInterface
{
    /**
     * @return array<array, mixed>|bool|int|string|stdClass|null
     */
    public function fake(): null|array|bool|int|string|stdClass;

    /**
     * @return DescriptionType
     */
    public function descriptions(): array;
}
