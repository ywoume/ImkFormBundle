<?php


namespace Imk\AuthBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class ImkAuthConfiguration implements ConfigurationInterface
{
    private $register;
    /**
     * @var void
     */
    private $login;
    /**
     * @var void
     */
    private $permissions;
    /**
     * @var void
     */
    private $roles;

    private $path;
    /**
     * @var void
     */
    private $providers;

    public function __construct()
    {
        $this->path = $this->buildPathConfig();
        $this->providers = $this->buildProvidersConfig();
        $this->register = $this->buildRegisterConfig();
        $this->login = $this->buildLoginConfig();
        $this->permissions = $this->buildPermissionsConfig();
        $this->roles = $this->buildRolesConfig();

    }

    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('imk_auth');
        $treeBuilder->getRootNode()
            ->children()
            ->append($this->path)
            ->append($this->providers)
            ->append($this->register)
            ->append($this->login)
            ->append($this->permissions)
            ->append($this->roles)
            ->end();
        return $treeBuilder;
    }


    private function buildRegisterConfig()
    {
        $this->register = new TreeBuilder('register');
        $this->register->getRootNode()
            ->arrayPrototype()
            ->children()
            ->scalarNode('pattern')->isRequired()->end()
            ->arrayNode('fields')
            ->arrayPrototype()
            ->children()
            ->scalarNode('type')->defaultValue('text')->end()
            ->integerNode('length')->defaultValue(255)->end()
            ->booleanNode('unique')->defaultValue(false)->end()
            ->scalarNode('entity')->defaultValue('users')->isRequired()->cannotBeEmpty()->end()
            ->booleanNode('hash')->defaultValue(false)->end()
            ->end()
            ->end()
            ->end()
            ->scalarNode('type')->defaultValue('form')->end()
            ->scalarNode('role')->defaultValue('ROLE_USER')->end()
            ->end()
            ->end()

            //->end()
            ->end();
        return $this->register->getRootNode();
    }

    private function buildLoginConfig()
    {
        $this->login = new TreeBuilder('login');
        $this->login->getRootNode()
            ->arrayPrototype()
            ->children()
            ->scalarNode('provider')->defaultValue('users')->end()
            ->scalarNode('pattern')->defaultValue('/login')->end()
            ->scalarNode('login_type')
            ->defaultValue('form')->end()
            ->scalarNode('class')->end()
            ->scalarNode('form')->end()
            ->scalarNode('extends')->end()
            ->scalarNode('auth_type')->end()
            ->scalarNode('public_key')->end()
            ->scalarNode('private_key')->end()
            ->scalarNode('api_token')->end()
            ->arrayNode('form_login')
            ->children()
            ->booleanNode('buildform')->defaultValue(true)->end()
            ->scalarNode('login_path')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('login_check')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('captcha')->end()
            ->scalarNode('remeber_me')->end()
            ->arrayNode('fields')->scalarPrototype()->end()->end()
            ->end()
            ->end()
            ->arrayNode('json_login')
            ->children()
            ->scalarNode('json_path')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('login_check')->isRequired()->cannotBeEmpty()->end()
            // ->scalarNode('login_check')->isRequired()->cannotBeEmpty()->end()
            ->end()
            ->end()
            /*->arrayNode('guards')
                ->arrayPrototype()->end()
            ->end()*/
            ->end()
            ->end()
            ->end();
        return $this->login->getRootNode();
    }

    private function buildPermissionsConfig()
    {
        $this->permissions = new TreeBuilder('permissions');
        $this->permissions->getRootNode()
            ->scalarPrototype()->end();
        return $this->permissions->getRootNode();
    }

    private function buildRolesConfig()
    {
        $this->roles = new TreeBuilder('roles');
        $this->roles->getRootNode()
            ->arrayPrototype()
            ->arrayPrototype()->scalarPrototype()->end()->end()
            //->arrayPrototype()->end()

            ->end();
        return $this->roles->getRootNode();
    }

    private function buildPathConfig()
    {
        $this->path = new TreeBuilder('path');
        $this->path->getRootNode()
            ->children()
            ->scalarNode('form')->defaultValue('App\Form\Types')->end()
            ->scalarNode('entity')->defaultValue('App\Entity')->end()
            ->scalarNode('dto')->defaultValue('App\Form\Dto')->end()
            ->end();
        return $this->path->getRootNode();
    }

    private function buildProvidersConfig()
    {
        $this->providers = new TreeBuilder('providers');
        $this->providers->getRootNode()
            ->arrayPrototype()
            ->children()
            ->scalarNode('class')->isRequired()->end()
            ->booleanNode('login')->defaultValue(false)->end()
            ->scalarNode('depends')->end()
            ->end();
        return $this->providers->getRootNode();
    }
}
