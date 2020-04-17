<?php

declare(strict_types=1);

namespace DependencyInjection;

use EJTJ3\TeamsBundle\DependencyInjection\Configuration;
use EJTJ3\TeamsBundle\DependencyInjection\EJTJ3TeamsExtension;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionConfigurationTestCase;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

class ConfigurationTest extends AbstractExtensionConfigurationTestCase
{
    public function testMinimalConfigurationProcess(): void
    {
        $expectedConfiguration = [
            'endpoint' => 'https://outlook.office.com/webhook/xxxxxxxx-xxxx-xxxxxxxx-xxxxxx-xxxxxx-xxx-xxxxxx/IncomingWebhook/xxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
        ];

        $sources = [
            __DIR__.'/../Fixtures/config/config.yml',
        ];

        $this->assertProcessedConfigurationEquals($expectedConfiguration, $sources);
    }

    /**
     * @inheritDoc
     */
    protected function getContainerExtension(): ExtensionInterface
    {
        return new EJTJ3TeamsExtension();
    }

    /**
     * @inheritDoc
     */
    protected function getConfiguration(): ConfigurationInterface
    {
        return new Configuration();
    }
}
