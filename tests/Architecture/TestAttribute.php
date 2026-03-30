<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Tests\Architecture;

use Attribute;
use StructuraPhp\Structura\Asserts\ToBeFinal;
use StructuraPhp\Structura\Attributes\TestDox;
use StructuraPhp\Structura\Except;
use StructuraPhp\Structura\Expr;
use StructuraPhp\Structura\Testing\TestBuilder;
use Sylarele\ObjectMetadataMapper\Attributes\Mapper;
use Sylarele\ObjectMetadataMapper\Attributes\ObjectMapper;

final class TestAttribute extends TestBuilder
{
    #[TestDox('Attribute architecture tests')]
    public function testAttribute(): void
    {
        $this
            ->allClasses()
            ->fromDir('src/Attributes')
            ->that(
                static fn (Expr $expr): Expr => $expr
                    ->notToBeInOneOfTheNamespaces(Mapper::class)
            )
            ->except(
                static fn (Except $except): Except => $except
                    ->byClassname(ObjectMapper::class, ToBeFinal::class)
            )
            ->should(
                static fn (Expr $expr): Expr => $expr
                    ->toUseStrictTypes()
                    ->toBeAttribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)
                    ->toHaveSuffix('Mapper')
                    ->toBeFinal()
                    ->toBeReadonly()
                    ->toExtend(Mapper::class)
                    ->toImplementNothing()
                    ->toNotUseTrait()
                    ->toNotHavePublicConstant()
            );
    }
}
