<?php


namespace Imk\FormBundle\Factory\Builder;


use Imk\FormBundle\Factory\LoadConfigFactory;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\Renderer\FormTypeRenderer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpKernel\KernelInterface;

class Builder
{
    /**
     * @var FormTypeRenderer
     */
    private $formTypeRenderer;
    /**
     * @var Generator
     */
    private $generator;
    /**
     * @var KernelInterface
     */
    private $kernel;
    /**
     * @var LoadConfigFactory
     */
    protected $loadConfigFactory;
    private $namespace;

    /**
     * GeneratorForm constructor.
     *
     * @param Generator         $generator
     * @param FormTypeRenderer  $formTypeRenderer
     * @param KernelInterface   $kernel
     * @param LoadConfigFactory $loadConfigFactory
     */
    public function __construct(Generator $generator, FormTypeRenderer $formTypeRenderer, KernelInterface $kernel, LoadConfigFactory $loadConfigFactory)
    {
        $this->generator = $generator;
        $this->formTypeRenderer = $formTypeRenderer;
        $this->kernel = $kernel;
        $this->loadConfigFactory = $loadConfigFactory;
        $this->namespace = (object)$loadConfigFactory->getFormsNamespace();
    }

    /**
     * @param string            $className
     * @param                   $dataRender
     * @param LoadConfigFactory $loadConfigFactory
     *
     * @throws \Exception
     */
    public function generateForm(string $className, $dataRender)
    {

        $useDependency = [];
        foreach ($fields as $itemField) {
            $useDependency[] = $itemField['type'];
        }

        $fieldsForm = [];
        foreach ($fields as $key => $itemField) {
            $fieldsForm[] = [
                $key => $itemField['type'],
            ];
        }

        $entityClassDetails = $this->generator->createClassNameDetails(
            $className,
            'Form\\Operations\\Type'
        );

        $dtoClass = str_replace('_', '', str_replace('Form', 'Dto', $className));

        $classExists = class_exists($entityClassDetails->getFullName());
        if (!$classExists) {
            // $entityClassGenerator = new EntityClassGenerator($this->generator);
            try {
                $this->generator->generateClass(
                    $entityClassDetails->getFullName(),
                    __DIR__.'/../../Render/form.tpl.php',
                    [
                        'class_name' => $className,
                        'form_fields' => $fieldsForm,
                        'namespace' => 'App\\Form\\Operations\\Type',
                        'useDependency' => $useDependency,
                        'dtoClass' => $dtoClass,
                    ]
                );
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage().' '.$e->getCode());
            }

            $this->generator->writeChanges();
        } else {
            throw new FileException('file not found');
        }

        echo 'Generation Form '.$className." -> at: ".(new \DateTime('now'))->format('d/m/Y h:i')."\n";
    }


    /**
     * @param string $className
     * @param array  $dataRender
     * @param array  $validator
     *
     * @param array  $uniqueEntity
     *
     * @param array  $addMethod
     *
     * @return void
     * @throws \Exception
     */
    public function generateDTO(string $className, array $dataRender, array $validator = [], array $addMethod = []): void
    {
        $entityClassDetails = $this->generator->createClassNameDetails(
            $className,
            $this->namespace->dto
        );
        $classExists = class_exists($entityClassDetails->getFullName());


        if (!$classExists) {

            try {

                $this->generator->generateClass(
                    $entityClassDetails->getFullName(),
                    __DIR__.'/../../Render/dto.tpl.php',
                    [
                        'class_name' => $className,
                        'form_fields' => $dataRender,
                        'form_validator' => $validator,
                        'namespaces' => 'App\\'.$this->namespace->dto,
                        'addMethod' => $addMethod,
                        //'validator' => $this->getValidators($fields)
                    ]
                );
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage().' '.$e->getCode());
            }

            $this->generator->writeChanges();
        } else {
            echo "No class avalaible";
        }

        echo 'Generation DTO '.$className." -> at: ".(new \DateTime('now'))->format('d/m/Y')."\n";
    }

    public function generateCalculate(string $className, $dataRender): void
    {

        $entityClassDetails = $this->generator->createClassNameDetails(
            $className,
            $this->namespace->dto
        );

        $classExists = class_exists($entityClassDetails->getFullName());

        if (!$classExists) {

            try {
                $this->generator->generateClass(
                    $entityClassDetails->getFullName(),
                    __DIR__.'/../../Render/dto.tpl.php',
                    [
                        'class_name' => $className,
                        'form_fields' => $dataRender,
                        'form_validator' => $dataRender,
                        'namespaces' => 'App\\Form\\Operations\\DTO',
                        'addMethod' => '',
                        //'validator' => $this->getValidators($fields)
                    ]
                );
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage().' '.$e->getCode());
            }

            $this->generator->writeChanges();
        } else {
            echo "No class avalaible";
        }

        echo 'Generation DTO '.$className." -> at: ".(new \DateTime('now'))->format('d/m/Y')."\n";
    }


    /**
     * @param array $fields
     * @param $name
     * @throws \Exception
     */
    public function generateTwig(array $fields, $name): void
    {

        try {
            $name = strtolower(str_replace(' ', '', str_replace('_', '-', $name))).'.html.twig';
            $this->generator->generateTemplate(
                'operations/'.$name,
                __DIR__.'/../Tpl/twig.tpl.php',
                [
                    'fields' => $fields,
                ]
            );
            $this->generator->writeChanges();
        } catch (\ClosedGeneratorException $generatorException) {
            throw new \Exception($generatorException->getMessage().'- '.$generatorException->getCode());
        }

    }


}