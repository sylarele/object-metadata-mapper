<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Contracts;

/**
 * @phpstan-type DescriptionType array<string, string>
 */
interface MapperInterface
{
    public function fake(): null|array|bool|int|string;

    /**
     * @return DescriptionType
     */
    public function descriptions(): array;
}
