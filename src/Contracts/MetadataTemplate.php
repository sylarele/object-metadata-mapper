<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Contracts;

use Sylarele\ObjectMetadataMapper\Dto\MetadataDto;
use UnitEnum;

interface MetadataTemplate
{
    public function template(): UnitEnum;

    public function description(): MetadataDto;
}
