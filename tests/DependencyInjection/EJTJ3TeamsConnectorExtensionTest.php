<?php

declare(strict_types=1);

namespace DependencyInjection;

use EJTJ3\Teams\Client;
use EJTJ3\TeamsBundle\DependencyInjection\EJTJ3TeamsExtension;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

class EJTJ3TeamsConnectorExtensionTest extends AbstractExtensionTestCase
{
    public function testLoadWithNoConfiguration(): void
    {
        $this->expectException(InvalidConfigurationException::class);
        $this->expectExceptionMessage('The child node "endpoint" at path "ejtj3_teams" must be configured.');

        $this->load();
    }

    public function testLoadWithConfiguration(): void
    {
        $endpoint = 'https://outlook.office.com/webhook/xxxxxxxx-xxxx-xxxxxxxx-xxxxxx-xxxxxx-xxx-xxxxxx/IncomingWebhook/xxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

        $this->load([
            'endpoint' => $endpoint,
        ]);

        $this->assertContainerBuilderHasParameter('ejtj3_teams.endpoint', $endpoint);
        $this->assertContainerBuilderHasService('ejtj3_teams.client');
        $this->assertContainerBuilderHasServiceDefinitionWithArgument('ejtj3_teams.client', 0, '%ejtj3_teams.endpoint%');
        $this->assertContainerBuilderHasAlias(Client::class, 'ejtj3_teams.client');
    }

    /**
     * @inheritDoc
     */
    protected function getContainerExtensions(): array
    {
        return [
          new EJTJ3TeamsExtension(),
        ];
    }
}
