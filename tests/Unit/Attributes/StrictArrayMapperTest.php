<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Tests\Unit\Attributes;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Sylarele\ObjectMetadataMapper\Attributes\ArrayMapper;
use Sylarele\ObjectMetadataMapper\Attributes\StrictArrayMapper;

/**
 * @internal
 */
#[CoversClass(ArrayMapper::class)]
final class StrictArrayMapperTest extends TestCase
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
