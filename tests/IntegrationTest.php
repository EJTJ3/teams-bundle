<?php

declare(strict_types=1);

use EJTJ3\Teams\Client;
use EJTJ3\TeamsBundle\EJTJ3TeamsBundle;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Symfony\Component\Routing\RouteCollectionBuilder;

class IntegrationTest extends TestCase
{
    public function testServiceIntegration(): void
    {
        $kernel = new EJTJ3TeamsConnectorIntegrationTestKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        // sanity check on service wiring
        $client = $container->get('ejtj3_teams.client');
        $this->assertInstanceOf(Client::class, $client);
    }
}

abstract class AbstractEJTJ3TeamsIntegrationTestKernel extends Kernel
{
    use MicroKernelTrait;

    public function __construct()
    {
        parent::__construct('test', true);
    }

    public function registerBundles()
    {
        return [
            new FrameworkBundle(),
            new EJTJ3TeamsBundle(),
        ];
    }

    public function getCacheDir()
    {
        return sys_get_temp_dir() . '/cache' . spl_object_hash($this);
    }

    public function getLogDir()
    {
        return sys_get_temp_dir() . '/logs' . spl_object_hash($this);
    }

    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader): void
    {
        $container->loadFromExtension('framework', [
            'secret' => 'foo',
        ]);

        $container->loadFromExtension('ejtj3_teams', [
            'endpoint' => 'http://localhost.com',
        ]);
    }
}

if (method_exists(AbstractEJTJ3TeamsIntegrationTestKernel::class, 'configureRouting')) {
    class EJTJ3TeamsConnectorIntegrationTestKernel extends AbstractEJTJ3TeamsIntegrationTestKernel
    {
        protected function configureRouting(RoutingConfigurator $routes): void
        {
        }
    }
} else {
    class EJTJ3TeamsConnectorIntegrationTestKernel extends AbstractEJTJ3TeamsIntegrationTestKernel
    {
        protected function configureRoutes(RouteCollectionBuilder $routes): void
        {
        }
    }
}
