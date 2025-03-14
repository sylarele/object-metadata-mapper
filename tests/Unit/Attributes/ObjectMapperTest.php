<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Tests\Unit\Attributes;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Sylarele\ObjectMetadataMapper\Attributes\ObjectMapper;
use Sylarele\ObjectMetadataMapper\Attributes\StringMapper;

#[CoversClass(ObjectMapper::class)]
class ObjectMapperTest extends TestCase
{
    private ObjectMapper $mapper;

    protected function setUp(): void
    {
        $this->mapper = new ObjectMapper(
            'example',
            new StringMapper('title', 'my title description', 'Lorem ipsum'),
        );
    }

    public function testFake(): void
    {
        $fake = $this->mapper->fake();

        self::assertEquals('Lorem ipsum', $fake->title);
    }

    public function testDescription(): void
    {
        $description = $this->mapper->descriptions();

        self::assertEquals(
            ['example.title' => 'my title description'],
            $description
        );
    }
}
