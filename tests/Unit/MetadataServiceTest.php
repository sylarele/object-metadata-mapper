<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Sylarele\ObjectMetadataMapper\Tests\Fixtures\Enums\ExampleType;
use Sylarele\ObjectMetadataMapper\Tests\Fixtures\ExempleMetadataService;

class MetadataServiceTest extends TestCase
{
    private ExempleMetadataService $service;

    protected function setUp(): void
    {
        $this->service = new ExempleMetadataService();
    }

    public function testFindByKey(): void
    {
        $metadataDto = $this
            ->service
            ->findByKey(ExampleType::Foo);

        $this->assertEquals(
            [
                'user.fullname' => 'nom et prénom d\'utilisateur',
                'user.phone' => 'numéro de téléphone',
                'user.email' => '',
                'user.addresses.0.address' => '',
                'user.addresses.1.address' => '',
            ],
            $metadataDto->description,
        );
        $this->assertEquals(
            [
                'user' => (object) [
                    'fullname' => 'John Smith',
                    'phone' => '04 00 00 00 00',
                    'email' => 'fake@example.fr',
                    'addresses' => [
                        (object) ['address' => 'Av. Gustave Eiffel, 75007 Paris'],
                        (object) ['address' => 'Av. Gustave Eiffel, 75007 Paris'],
                    ],
                ],
            ],
            $metadataDto->fake,
        );
    }
}
