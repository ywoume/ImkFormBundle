<?php


namespace Imk\FormBundle\Factory;


use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Yaml\Yaml;

class LoadConfigFactory
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    private $pathConfig;
    /**
     * @var KernelInterface
     */
    private $kernel;
    /**
     * @var ParameterBag
     */
    private $parameterBag;
    /**
     * @var string
     */
    private $dirConfig;

    /**
     * LoadConfigFactory constructor.
     * @param Filesystem $filesystem
     * @param KernelInterface $kernel
     * @param ParameterBagInterface $parameterBag
     */
    public function __construct(Filesystem $filesystem, KernelInterface $kernel, ParameterBagInterface $parameterBag)
    {
        $this->filesystem = $filesystem;
        $this->kernel = $kernel;
        $this->parameterBag = $parameterBag;
        $this->getFormConfigPath();
    }

    public function getFormConfigPath()
    {
        $this->pathConfig = $this->kernel->getProjectDir().'/config/forms/forms.yaml';

        return $this;
    }

    protected function getDirConfig(): string
    {
        return $this->dirConfig = $this->kernel->getProjectDir().'/config/forms/';
    }

    public function readFileConfig()
    {
        return Yaml::parseFile($this->pathConfig);
    }

    public function getForms(): array
    {
        $files = (object)$this->readFileConfig();
        $imkForm = $files->imk_form['forms']['imports'];

        if (is_array($imkForm) && count($imkForm) > 0) {
            $formParse = [];
            $result = [];
            foreach ($imkForm as $key => $item) {
                $formParse[] = Yaml::parseFile($this->getDirConfig().'/'.$item['resource']);
                foreach ($formParse as $k => $itemParse) {
                    foreach ($itemParse as $key => $item) {
                        $result[$key] = $item;
                    }
                }
            }

            return $result;
        }

        return [];
    }

    public function getForm(string $name): array
    {
        return $this->getForms()[$name];
    }

    /* private function loop($dataToLoop) : array
     {
         if(is_array($dataToLoop) && count($dataToLoop) > 0 ) {
             $result = [];
             foreach ($dataToLoop as $key => $item) {
                 $result[$key] = $item;
             }
             return $result;
         }
         return [];
     }*/

}