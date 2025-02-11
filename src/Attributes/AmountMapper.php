<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Attributes;

namespace Sylarele\ObjectMetadataMapper\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class AmountMapper extends Mapper
{
    public function __construct(
        string $key,
        string $description = '',
        public string $default = '10.00'
    ) {
        parent::__construct($key, $description);
    }

    public function fake(): string
    {
        return $this->default;
    }
}
