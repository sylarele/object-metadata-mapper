<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Attributes;

namespace Sylarele\ObjectMetadataMapper\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class BooleanMapper extends Mapper
{
    public function __construct(
        string $key,
        string $description = '',
        public bool $default = true,
    ) {
        parent::__construct($key, $description);
    }

    public function fake(): bool
    {
        return $this->default;
    }
}
