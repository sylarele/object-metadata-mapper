<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Dto;

use UnitEnum;

final readonly class MetadataDto
{
    /**
     * @param array<string, string> $description
     */
    public function __construct(
        public UnitEnum $template,
        public array $description,
        public array $fake,
    ) {
    }
}
