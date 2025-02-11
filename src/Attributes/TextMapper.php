<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Attributes;

use Attribute;
use InvalidArgumentException;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class TextMapper extends Mapper
{
    private const string DEFAULT = <<<'TXT'
        Lorem ipsum dolor sit amet, consectetur adipiscing  elit.
        Morbi ullamcorper, nunc sed ornare feugiat, elit ligula semper lorem,
        nec commodo tortor neque sit amet ante. Fusce mi eros, dignissim vel augue.
        TXT;

    public function __construct(
        string $key,
        string $description = '',
        public string $default = self::DEFAULT,
    ) {
        if (\strlen($default) < 60) {
            throw new InvalidArgumentException(
                'Default value must be at least 60 characters long; use StringMapper'
            );
        }

        parent::__construct($key, $description);
    }

    public function fake(): string
    {
        return $this->default;
    }
}
