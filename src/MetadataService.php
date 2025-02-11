<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper;

use ReflectionClass;
use Sylarele\ObjectMetadataMapper\Attributes\Mapper;
use Sylarele\ObjectMetadataMapper\Builders\MetadataBuilder;
use Sylarele\ObjectMetadataMapper\Dto\MetadataDto;
use UnitEnum;

abstract class MetadataService
{
    public function findByKey(UnitEnum $keyTemplate): MetadataDto
    {
        $className = $this->getClassName($keyTemplate);

        $ref = new ReflectionClass($className);
        $attrs = $ref->getAttributes();

        $builder = new MetadataBuilder();

        foreach ($attrs as $attr) {
            /** @var Mapper $instance */
            $instance = $attr->newInstance();
            $builder->addMapper($instance);
        }

        return $builder->toDescriptionMailDto($keyTemplate);
    }

    /**
     * @return class-string
     */
    abstract protected function getClassName(UnitEnum $keyTemplate): string;
}
