<?php


namespace Imk\AuthBundle\Factory;


use App\Kernel;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Yaml\Yaml;

class FileLoadConfig
{
    /**
     * @var Filesystem
     */
    private $fs;

    /**
     * @var Finder
     */
    private $finder;

    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * FileLoadConfig constructor.
     *
     * @param KernelInterface $kernel
     */
    public function __construct(KernelInterface $kernel)
    {
        $this->fs = new Filesystem();
        $this->finder = new Finder();
        $this->kernel = $kernel;
    }

    /**
     * @return string
     */
    public function getDtoPath()
    {
        if (!$this->fs->exists($this->namespaceToPath($this->getPathConfig()['dto']))) {
            $this->createDirectory($this->getPathConfig()['dto']);
        }
        return $this->namespaceToPath($this->getPathConfig()['dto']);
    }

    /**
     * @return string
     */
    public function getEntityPath()
    {
        if (!$this->fs->exists($this->namespaceToPath($this->getPathConfig()['entity']))) {
            $this->createDirectory($this->getPathConfig()['entity']);
        }
        return $this->namespaceToPath($this->getPathConfig()['entity']);
    }

    /**
     * @return string
     */
    public function getFormPath()
    {

        if (!$this->fs->exists($this->namespaceToPath($this->getPathConfig()['form']))) {
            $this->createDirectory($this->getPathConfig()['form']);
        }
        return $this->namespaceToPath($this->getPathConfig()['form']);
    }

    private function createDirectory(string $params)
    {
        $this->fs->mkdir($this->namespaceToPath($params));
    }

    private function namespaceToPath(string $namespace)
    {
        return $this->kernel->getProjectDir() . str_replace('App', '/src', str_replace('\\', DIRECTORY_SEPARATOR, $namespace));
    }

    private function getRolesConfig()
    {
        $config = $this->getConfig();
        return $config['roles'];
    }

    private function getPermissionConfig()
    {
        $config = $this->getConfig();
        return $config['permissions'];
    }

    private function getLoginConfig()
    {
        $config = $this->getConfig();
        return $config['login'];
    }

    private function getRegisterConfig()
    {
        $config = $this->getConfig();
        return $config['register'];
    }

    private function getProviders()
    {
        $config = $this->getConfig();
        return $config['providers'];
    }

    private function getPathConfig()
    {
        $config = $this->getConfig();
        return $config['path'];
    }

    private function getConfig()
    {
        try {
            if ($this->isExist()) {
                //dd(Yaml::parseFile($this->getConfigFile()));
                return Yaml::parseFile($this->getConfigFile())['imk_auth'];
            }
        } catch (\Exception $e) {
        }
    }

    /**
     * @return bool
     * @throws \Exception
     */
    private function isExist()
    {
        $this->finder->files()->in($this->kernel->getProjectDir() . '/config/packages');
        $result = [];
        foreach ($this->finder as $key => $item) {
            $result[$key] = $item->getFilename();
        }
        $filename = array_search('imk_auth_bundle.yaml', $result);
        if ($filename) {
            return true;
        }
        throw  new \Exception('file config imk_auth_bundle.yaml not found');
    }

    /**
     * @return string
     */
    private function getConfigFile(): string
    {

        return $this->kernel->getProjectDir() . '/config/packages/imk_auth_bundle.yaml';
    }
}
