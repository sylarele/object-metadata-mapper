<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Attributes;

use Sylarele\ObjectMetadataMapper\Contracts\MapperInterface;

abstract readonly class Mapper implements MapperInterface
{
    public function __construct(
        public string $key,
        public string $description,
    ) {
    }

    /**
     * @return array<string, string>
     */
    public function descriptions(): array
    {
        return [$this->key => $this->description];
    }
}
