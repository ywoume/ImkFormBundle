<?php


namespace Imk\FormBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class ImkFormConfiguration implements ConfigurationInterface
{

    /**
     * Generates the configuration tree builder.
     *
     * @return TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('imk_form');
        $treeBuilder->getRootNode()
            ->children()
                        ->scalarNode('form_template')->end()
                        ->scalarNode('form_config')->end()
                        ->scalarNode('form_type')->end()
                        ->scalarNode('form_dto')->end()
            ->end()
        ;
        return $treeBuilder;
    }
}