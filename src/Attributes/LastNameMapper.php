<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class LastNameMapper extends Mapper
{
    public function __construct(
        string $key,
        string $description = "nom d'utilisateur",
        public string $default = 'Smith',
    ) {
        parent::__construct($key, $description);
    }

    public function fake(): string
    {
        return $this->default;
    }
}
