<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Tests\Architecture;

use StructuraPhp\Structura\Attributes\TestDox;
use StructuraPhp\Structura\Expr;
use StructuraPhp\Structura\Testing\TestBuilder;

final class TestDto extends TestBuilder
{
    #[TestDox('Dto architecture tests')]
    public function testDto(): void
    {
        $this
            ->allClasses()
            ->fromDir('src/Dto')
            ->should(
                static fn (Expr $expr): Expr => $expr
                    ->toUseStrictTypes()
                    ->toBeClasses()
                    ->toHaveSuffix('Dto')
                    ->toBeFinal()
                    ->toBeReadonly()
                    ->toExtendsNothing()
                    ->toNotUseTrait()
                    ->toNotHavePublicConstant()
            );
    }
}
