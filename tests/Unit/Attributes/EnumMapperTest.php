<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Tests\Unit\Attributes;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Sylarele\ObjectMetadataMapper\Attributes\EnumMapper;
use Sylarele\ObjectMetadataMapper\Attributes\ObjectMapper;
use Sylarele\ObjectMetadataMapper\Tests\Fixtures\Enums\ExampleIntType;
use Sylarele\ObjectMetadataMapper\Tests\Fixtures\Enums\ExampleType;

/**
 * @internal
 */
#[CoversClass(EnumMapper::class)]
final class EnumMapperTest extends TestCase
{
    public function testFakeReturnsFirstCaseByDefault(): void
    {
        $mapper = new EnumMapper('type', ExampleType::class);

        self::assertSame(ExampleType::Foo, $mapper->fake());
    }

    public function testFakeReturnsDefault(): void
    {
        $mapper = new EnumMapper('type', ExampleIntType::class, default: ExampleIntType::Two);

        self::assertSame(ExampleIntType::Two, $mapper->fake());
    }

    public function testGeneratedDescription(): void
    {
        $mapper = new EnumMapper('type', ExampleIntType::class);

        self::assertSame(['type' => '1, 2'], $mapper->descriptions());
    }

    public function testCustomDescription(): void
    {
        $mapper = new EnumMapper('type', ExampleType::class, 'my type');

        self::assertSame(['type' => 'my type'], $mapper->descriptions());
    }

    public function testFakeInsideObjectMapper(): void
    {
        $mapper = new ObjectMapper('example', new EnumMapper('type', ExampleType::class));

        self::assertSame(ExampleType::Foo, $mapper->fake()->type);
    }
}
