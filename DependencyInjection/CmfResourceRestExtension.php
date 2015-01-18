<?php

/*
 * This file is part of the Symfony CMF package.
 *
 * (c) 2011-2014 Symfony CMF
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Cmf\Bundle\ResourceRestBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

class CmfResourceRestExtension extends Extension implements PrependExtensionInterface
{
    public function prepend(ContainerBuilder $container)
    {
        $container->prependExtensionConfig('jms_serializer', array(
            'metadata' => array(
                'directories' => array(
                    array(
                        'path' => __DIR__ . '/../Resources/config/serializer',
                        'namespace_prefix' => 'Symfony\Cmf\Component\Resource\Repository\Resource',
                    ),
                    array(
                        'path' => __DIR__ . '/../Resources/config/serializer',
                        'namespace_prefix' => 'Puli\Repository\Resource',
                    ),
                    array(
                        'path' => __DIR__ . '/../Resources/config/serializer',
                        'namespace_prefix' => 'PHPCR',
                    ),
                ),
            ),
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('serializer.xml');
        $loader->load('resource-rest.xml');
    }
}