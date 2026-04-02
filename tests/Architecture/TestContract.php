<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Tests\Architecture;

use StructuraPhp\Structura\Asserts\ToBeFinal;
use StructuraPhp\Structura\Attributes\TestDox;
use StructuraPhp\Structura\Except;
use StructuraPhp\Structura\Expr;
use StructuraPhp\Structura\Testing\TestBuilder;
use Sylarele\ObjectMetadataMapper\Attributes\Mapper;
use Sylarele\ObjectMetadataMapper\Attributes\ObjectMapper;

final class TestContract extends TestBuilder
{
    #[TestDox('Contract architecture tests')]
    public function testContract(): void
    {
        $this
            ->allClasses()
            ->fromDir('src/Contracts')
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
                    ->toBeInterfaces()
                    ->toHaveSuffix('Interface')
                    ->toNotUseTrait()
                    ->toNotHavePublicConstant()
            );
    }
}
