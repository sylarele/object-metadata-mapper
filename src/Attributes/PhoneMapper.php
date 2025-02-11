<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class PhoneMapper extends Mapper
{
    public function __construct(
        string $key,
        string $description = 'numéro de téléphone',
        public string $default = '04 00 00 00 00',
    ) {
        parent::__construct($key, $description);
    }

    public function fake(): string
    {
        return $this->default;
    }
}
