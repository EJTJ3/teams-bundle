<?php

declare(strict_types=1);

namespace EJTJ3\TeamsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    private const TREE_BUILDER = 'ejtj3_teams';

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder(static::TREE_BUILDER);

        if (method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            // BC layer for symfony/config 4.1 and older
            $rootNode = $treeBuilder->root(static::TREE_BUILDER);
        }

        $rootNode
            ->children()
                ->scalarNode('endpoint')
                    ->isRequired()->cannotBeEmpty()
                    ->info('The Microsoft teams incoming webHooks URL.')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
