<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Tests\Unit\Attributes;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Sylarele\ObjectMetadataMapper\Attributes\StrictArrayEachMapper;
use Sylarele\ObjectMetadataMapper\Attributes\StrictArrayMapper;

#[CoversClass(StrictArrayMapper::class)]
class StrictArrayEachMapperTest extends TestCase
{
    private StrictArrayEachMapper $mapper;

    protected function setUp(): void
    {
        $this->mapper = new StrictArrayEachMapper(
            'example',
            2,
            [
                'title' => 'Lorem ipsum',
            ]
        );
    }

    public function testFake(): void
    {
        $fake = $this->mapper->fake();
        self::assertCount(2, $fake);
        self::assertSame(
            [
                'example.0.title' => 'Lorem ipsum',
                'example.1.title' => 'Lorem ipsum',
            ],
            $fake
        );
    }

    public function testDescription(): void
    {
        $description = $this->mapper->descriptions();

        self::assertEquals(
            [
                'example.0.title' => '',
                'example.1.title' => '',
            ],
            $description
        );
    }
}
