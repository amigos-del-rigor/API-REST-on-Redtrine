<?php

namespace ADR\RESTBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('adrrest');
        $rootNode
            ->children()
                ->arrayNode('hasher')
                    ->children()
                        ->booleanNode('enabled')
                            ->info('Enable this option!')
                            ->defaultFalse()
                        ->end()
                    ->end()
                    ->children()
                        ->scalarNode('type')
                        ->end()
                    ->end()
                    ->children()
                        ->scalarNode('mode')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('lockService')
                    ->children()
                        ->scalarNode('type')
                            ->validate()
                            ->ifNotInArray(array('redis', 'memcached'))
                                ->thenInvalid('The type must be redis or alternatives!')
                            ->end()
                        ->end()
                    ->end()
                    ->children()
                        ->scalarNode('timeout')
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('handler')
                ->end()
                ->arrayNode('storage')
                    ->children()
                        ->arrayNode('instances')
                            ->requiresAtLeastOneElement()
                                ->useAttributeAsKey('name')
                                ->prototype('array')
                                    ->children()
                                        ->scalarNode('type')
                                        ->end()
                                    ->end()
                                    ->children()
                                        ->scalarNode('address')
                                            ->cannotBeEmpty()
                                            ->isRequired()
                                        ->end()
                                    ->end()
                                    ->children()
                                        ->scalarNode('port')
                                            ->defaultValue(3679)
                                        ->end()
                                    ->end()
                                    ->children()
                                        ->scalarNode('database')
                                            ->isRequired()
                                            ->validate()
                                            ->ifTrue(function ($v) { return !is_numeric($v) || is_null($v); })
                                                ->thenInvalid('Redis port must be a valid integer!')
                                            ->end()
                                        ->end()
                                    ->end()
                                    ->children()
                                        ->scalarNode('namespace')
                                            ->isRequired()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
