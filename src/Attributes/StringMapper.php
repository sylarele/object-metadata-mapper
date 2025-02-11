<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Attributes;

use Attribute;
use InvalidArgumentException;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class StringMapper extends Mapper
{
    public function __construct(
        string $key,
        string $description = '',
        public string $default = 'Lorem ipsum',
    ) {
        if (\strlen($this->default) > 60) {
            throw new InvalidArgumentException(
                'Default value must be less than 60 characters; use TextMapper'
            );
        }

        parent::__construct($key, $description);
    }

    public function fake(): string
    {
        return $this->default;
    }
}
