<?php

namespace FDevs\Bridge\Serializer\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class FDevsSerializerExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');
        $bundles = $container->getParameter('kernel.bundles');
        foreach ($bundles as $name => $class) {
            $ref = new \ReflectionClass($class);
            $path = realpath(dirname($ref->getFileName()) . '/Resources/config/fdevs_serializer');
            if ($path) {
                $config['files'][] = [
                    'namespace' => $ref->getNamespaceName(),
                    'path' => $path,
                    'extension' => 'xml',
                ];
            }
        }
        $files = [];
        foreach ($config['files'] as $file) {
            $files = array_merge($files, $this->readPath($file['namespace'], $file['path'], $file['extension']));
        }
        $container
            ->getDefinition('f_devs_serializer.mapping.loader.xml_files')
            ->replaceArgument(0, $files);
    }

    /**
     * @param $prefix
     * @param $dir
     * @param $extension
     *
     * @return array
     */
    private function readPath($prefix, $dir, $extension)
    {
        $files = [];
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($dir),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );
        $nsPrefix = $prefix !== '' ? $prefix . '\\' : '';
        foreach ($iterator as $file) {
            if (($fileName = $file->getBasename('.' . $extension)) == $file->getBasename()) {
                continue;
            }
            $files[$nsPrefix . str_replace('.', '\\', $fileName)] = $file->getPathName();
        }

        return $files;
    }
}
