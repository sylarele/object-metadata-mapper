<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Dto;

use BackedEnum;

/**
 * @template TEnum of BackedEnum
 */
final readonly class MetadataDto
{
    /**
     * @param TEnum $template
     * @param array<string, string> $description
     * @param array<array, mixed> $fake
     */
    public function __construct(
        public BackedEnum $template,
        public array $description,
        public array $fake,
    ) {
    }
}
