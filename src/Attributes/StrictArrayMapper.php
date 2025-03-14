<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class StrictArrayMapper extends Mapper
{
    /**
     * Use only for simple arrays.
     */
    public function __construct(
        string $key,
        string $description = '',
        public array $default = []
    ) {
        parent::__construct($key, $description);
    }

    public function fake(): array
    {
        return $this->default;
    }
}
