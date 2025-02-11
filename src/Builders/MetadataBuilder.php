<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Builders;

use Sylarele\ObjectMetadataMapper\Attributes\Mapper;
use Sylarele\ObjectMetadataMapper\Contracts\MapperInterface;
use Sylarele\ObjectMetadataMapper\Dto\MetadataDto;
use UnitEnum;

/**
 * @phpstan-import-type DescriptionType from MapperInterface
 */
final class MetadataBuilder
{
    /** @var DescriptionType */
    private array $description = [];

    private array $fake = [];

    public function toDescriptionMailDto(UnitEnum $mailTemplate): MetadataDto
    {
        return new MetadataDto(
            $mailTemplate,
            $this->description,
            $this->fake
        );
    }

    public function addMapper(Mapper $mapper): void
    {
        $this->description += $mapper->descriptions();

        if ($mapper->key === '') {
            $this->fake += $mapper->fake();
        } else {
            $this->fake[$mapper->key] = $mapper->fake();
        }
    }
}
