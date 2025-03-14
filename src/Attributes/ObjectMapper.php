<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Attributes;

use Attribute;
use Override;
use stdClass;
use Sylarele\ObjectMetadataMapper\Helpers\Arr;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
readonly class ObjectMapper extends Mapper
{
    /** @var array<array-key, Mapper> */
    public array $mappers;

    public function __construct(string $key, Mapper ...$mappers)
    {
        parent::__construct($key, '');
        $this->mappers = $mappers;
    }

    #[Override]
    public function descriptions(): array
    {
        $descriptions = [];

        foreach ($this->mappers as $mapper) {
            if ($mapper instanceof ObjectMapper || $mapper instanceof ObjectEachMapper) {
                $descriptions = array_merge($descriptions, $mapper->descriptions());
            } else {
                $descriptions[$mapper->key] = $mapper->description;
            }
        }

        return $this->key === ''
            ? $descriptions
            : Arr::prependKeysWith($descriptions, $this->key.'.');
    }

    public function fake(): stdClass
    {
        $fake = [];

        foreach ($this->mappers as $mapper) {
            $fake[$mapper->key] = $mapper->fake();
        }

        return (object) $fake;
    }
}
