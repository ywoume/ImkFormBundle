<?php


namespace Imk\FormBundle\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\Routing\Loader\XmlFileLoader;

class ImkFormExtension extends Extension implements LoadConfigInterface
{
    private $config;

    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new ImkFormConfiguration();

        $this->config = $this->processConfiguration($configuration, $configs);
    }

    public function displayConfig()
    {

    }

}