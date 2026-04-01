<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Tests\Unit\Attributes;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use stdClass;
use Sylarele\ObjectMetadataMapper\Attributes\ObjectEachMapper;
use Sylarele\ObjectMetadataMapper\Attributes\StringMapper;

/**
 * @internal
 */
#[CoversClass(ObjectEachMapper::class)]
final class ObjectEachMapperTest extends TestCase
{
    private ObjectEachMapper $mapper;

    protected function setUp(): void
    {
        $this->mapper = new ObjectEachMapper(
            'example',
            2,
            new StringMapper('title', 'my title description', 'Lorem ipsum'),
        );
    }

    public function testFake(): void
    {
        $fake = $this->mapper->fake();

        self::assertCount(2, $fake);

        foreach ($fake as $value) {
            self::assertInstanceOf(stdClass::class, $value);
            self::assertSame('Lorem ipsum', $value->title);
        }
    }

    public function testDescription(): void
    {
        $description = $this->mapper->descriptions();

        self::assertCount(2, $description);
        self::assertSame([
            'example.0.title' => 'my title description',
            'example.1.title' => 'my title description',
        ], $description);
    }
}
