<?php

namespace FDevs\Bridge\Serializer\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class OptionPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('f_devs_serializer.option_registry')) {
            $definition = $container->getDefinition('f_devs_serializer.option_registry');
            $taggedServices = $container->findTaggedServiceIds('f_devs_serializer.option');
            foreach ($taggedServices as $id => $tags) {
                foreach ($tags as $tag) {
                    $name = isset($tag['option-name']) ? $tag['option-name'] : null;
                    $definition->addMethodCall('addOption', [new Reference($id), $name]);
                }
            }
        }
    }
}
