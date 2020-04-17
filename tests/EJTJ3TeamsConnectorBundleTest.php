<?php

declare(strict_types=1);


use EJTJ3\TeamsBundle\EJTJ3TeamsBundle;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractContainerBuilderTestCase;

class EJTJ3TeamsConnectorBundleTest extends AbstractContainerBuilderTestCase
{
    /**
     * @var EJTJ3TeamsBundle
     */
    protected $bundle;

    protected function setUp(): void
    {
        parent::setUp();

        $this->bundle = new EJTJ3TeamsBundle();
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testBuild(): void
    {
        $this->bundle->build($this->container);
    }
}
