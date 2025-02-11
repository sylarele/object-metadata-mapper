<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class ImageMapper extends Mapper
{
    public function __construct(
        string $key,
        string $description = '',
        public string $default = 'https://placecats.com/600/200',
    ) {
        parent::__construct($key, $description);
    }

    public function fake(): string
    {
        return $this->default;
    }
}
