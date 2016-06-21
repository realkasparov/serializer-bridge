<?php

namespace FDevs\Bridge\Serializer\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class DataTypePass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('f_devs_serializer.data_type_factory')) {
            $definition = $container->getDefinition('f_devs_serializer.data_type_factory');
            $taggedServices = $container->findTaggedServiceIds('f_devs_serializer.data_type');
            foreach ($taggedServices as $id => $tags) {
                $definition->addMethodCall('addType', [new Reference($id)]);
                $class = $container->getDefinition($id)->getClass();
                foreach ($tags as $tag) {
                    if (isset($tag['type']) && $tag['type']) {
                        $definition->addMethodCall('addMappingType', [$tag['type'], $class]);
                    }
                }
            }
        }
    }
}
