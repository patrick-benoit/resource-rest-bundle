<?php

/*
 * This file is part of the Symfony CMF package.
 *
 * (c) 2011-2017 Symfony CMF
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Cmf\Bundle\ResourceRestBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Returns the config tree builder.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $treeBuilder->root('cmf_resource_rest')
            ->fixXmlConfig('payload_alias', 'payload_alias_map')
            ->children()
                ->integerNode('max_depth')->defaultValue(2)->end()
                ->booleanNode('expose_payload')->defaultFalse()->end()
                ->arrayNode('payload_alias_map')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                         ->children()
                             ->scalarNode('repository')->end()
                             ->scalarNode('type')->end()
                         ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}