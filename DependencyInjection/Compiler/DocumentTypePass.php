<?php

namespace FDevs\Bridge\Serializer\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;

class DocumentTypePass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('doctrine_mongodb')) {
            $this->getLoader($container)->load('mongodb.xml');
        }
    }

    /**
     * @param ContainerBuilder $container
     *
     * @return Loader\XmlFileLoader
     */
    private function getLoader(ContainerBuilder $container)
    {
        return new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../../Resources/config'));
    }
}
