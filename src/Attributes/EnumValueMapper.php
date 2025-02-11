<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Attributes;

use Attribute;
use BackedEnum;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class EnumValueMapper extends Mapper
{
    /**
     * @param class-string<BackedEnum> $enum
     */
    public function __construct(
        string $key,
        public string $enum,
        ?string $description = null,
    ) {
        parent::__construct($key, $this->generateDescription($description));
    }

    public function fake(): int|string
    {
        return $this->enum::cases()[0]->value;
    }

    private function generateDescription(?string $description): string
    {
        if ($description === null) {
            return implode(
                ', ',
                array_map(
                    static fn (BackedEnum $value): string => \strval($value->value),
                    $this->enum::cases(),
                ),
            );
        }

        return $description;
    }
}
