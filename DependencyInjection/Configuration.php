<?php

namespace FDevs\Bridge\Serializer\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('f_devs_serializer');

        $rootNode
            ->children()
                ->arrayNode('files')
                    ->defaultValue([])
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('path')->isRequired()->end()
                            ->scalarNode('namespace')->defaultValue('')->end()
                            ->scalarNode('extension')->defaultValue('xml')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }

}
