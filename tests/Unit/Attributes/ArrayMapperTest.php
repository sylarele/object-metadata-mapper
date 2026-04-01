<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Tests\Unit\Attributes;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Sylarele\ObjectMetadataMapper\Attributes\ArrayMapper;
use Sylarele\ObjectMetadataMapper\Attributes\StringMapper;

/**
 * @internal
 */
#[CoversClass(ArrayMapper::class)]
final class ArrayMapperTest extends TestCase
{
    private ArrayMapper $mapper;

    protected function setUp(): void
    {
        $this->mapper = new ArrayMapper(
            'example',
            new StringMapper('title', 'my title description', 'Lorem ipsum'),
        );
    }

    public function testFake(): void
    {
        $fake = $this->mapper->fake();

        self::assertEquals('Lorem ipsum', $fake['title']);
    }

    public function testDescription(): void
    {
        $description = $this->mapper->descriptions();

        self::assertSame(['example.title' => 'my title description'], $description);
    }
}
