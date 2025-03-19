<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper;

use BackedEnum;
use ReflectionClass;
use Sylarele\ObjectMetadataMapper\Attributes\Mapper;
use Sylarele\ObjectMetadataMapper\Builders\MetadataBuilder;
use Sylarele\ObjectMetadataMapper\Dto\MetadataDto;

/**
 * @template TEnum of BackedEnum
 */
abstract class MetadataService
{
    /**
     * @param TEnum $keyTemplate
     * @return MetadataDto<TEnum>
     */
    public function findByKey(BackedEnum $keyTemplate): MetadataDto
    {
        $className = $this->getClassName($keyTemplate);

        $ref = new ReflectionClass($className);
        $attrs = $ref->getAttributes();

        /** @var MetadataBuilder<TEnum> $builder */
        $builder = new MetadataBuilder();

        foreach ($attrs as $attr) {
            /** @var Mapper $instance */
            $instance = $attr->newInstance();
            $builder->addMapper($instance);
        }

        return $builder->toDescriptionMailDto($keyTemplate);
    }

    /**
     * @param TEnum $keyTemplate
     * @return class-string
     */
    abstract protected function getClassName(BackedEnum $keyTemplate): string;
}
