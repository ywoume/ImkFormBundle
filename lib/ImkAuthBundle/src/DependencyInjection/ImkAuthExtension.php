<?php


namespace Imk\AuthBundle\DependencyInjection;


use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class ImkAuthExtension extends Extension
{
    /**
     * @var array
     */
    private $config;

    /**
     * Loads a specific configuration.
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $this->config = $configs;
        $imkAuthConfig = new ImkAuthConfiguration();
        $this->processConfiguration($imkAuthConfig, $configs);
    }
}
