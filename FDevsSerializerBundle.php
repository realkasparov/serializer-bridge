<?php

namespace FDevs\Bridge\Serializer;

use FDevs\Bridge\Serializer\DependencyInjection\Compiler\DocumentTypePass;
use FDevs\Bridge\Serializer\DependencyInjection\Compiler\OptionPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FDevsSerializerBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container
            ->addCompilerPass(new DocumentTypePass())
            ->addCompilerPass(new OptionPass())
        ;
    }
}
