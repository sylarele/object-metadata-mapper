<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class FirstNameMapper extends Mapper
{
    public function __construct(
        string $key,
        string $description = 'prénom d\'utilisateur',
        public string $default = 'John',
    ) {
        parent::__construct($key, $description);
    }

    public function fake(): string
    {
        return $this->default;
    }
}
