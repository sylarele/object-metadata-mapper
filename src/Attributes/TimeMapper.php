<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Attributes;

use Attribute;
use DateTime;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class TimeMapper extends Mapper
{
    public function __construct(
        string $key,
        string $description = '',
        public string $format = 'H:i',
    ) {
        parent::__construct($key, $description);
    }

    public function fake(): string
    {
        return (new DateTime())->format($this->format);
    }
}
