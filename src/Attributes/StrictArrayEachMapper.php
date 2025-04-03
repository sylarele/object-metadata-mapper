<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Attributes;

use Attribute;
use Override;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class StrictArrayEachMapper extends Mapper
{
    /**
     * @param array<string, scalar|null> $default
     */
    public function __construct(
        string $key,
        public int $count = 3,
        public array $default = []
    ) {
        parent::__construct($key, '');
    }

    #[Override]
    public function descriptions(): array
    {
        $descriptions = [];

        for ($i = 0; $i < $this->count; $i++) {
            foreach (array_keys($this->default) as $key) {
                $descriptions[$this->key . '.' . $i . '.' . $key] = '';
            }
        }


        return $descriptions;
    }

    /**
     * @return array<string, scalar|null>
     */
    public function fake(): array
    {
        $result = [];

        for ($i = 0; $i < $this->count; $i++) {
            foreach ($this->default as $key => $mapper) {
                $result[$this->key . '.' . $i . '.' . $key] = $mapper;
            }
        }

        return $result;
    }
}
