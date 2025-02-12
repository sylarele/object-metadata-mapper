<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Attributes;

use Attribute;
use Override;
use Sylarele\ObjectMetadataMapper\Helpers\Arr;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class ObjectEachMapper extends Mapper
{
    /** @var array<Mapper> */
    public array $mappers;

    public function __construct(
        string $key,
        public int $count = 3,
        Mapper ...$mappers
    ) {
        parent::__construct($key, '');
        $this->mappers = $mappers;
    }

    #[Override]
    public function descriptions(): array
    {
        $descriptions = [];

        for ($i = 0; $i < $this->count; $i++) {
            foreach ($this->mappers as $mapper) {
                if ($mapper instanceof ObjectEachMapper || $mapper instanceof ObjectMapper) {
                    $descriptions = array_merge($descriptions, $mapper->descriptions());
                } else {
                    $descriptions[$i.'.'.$mapper->key] = $mapper->description;
                }
            }
        }


        return Arr::prependKeysWith($descriptions, $this->key.'.');
    }

    public function fake(): array
    {
        $result = [];

        for ($i = 0; $i < $this->count; $i++) {
            foreach ($this->mappers as $mapper) {
                $result[$i][$mapper->key] = $mapper->fake();
            }
        }

        return $result;
    }
}
