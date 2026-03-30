<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Tests\Unit\Attributes;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Sylarele\ObjectMetadataMapper\Attributes\StrictArrayMapper;

#[CoversClass(StrictArrayMapper::class)]
final class StrictArrayEachMapperTest extends TestCase
{
    private StrictArrayMapper $mapper;

    protected function setUp(): void
    {
        $this->mapper = new StrictArrayMapper(
            'example',
            'my example description',
            [
                'title' => 'Lorem ipsum',
            ]
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

        self::assertSame(['example' => 'my example description'], $description);
    }
}
