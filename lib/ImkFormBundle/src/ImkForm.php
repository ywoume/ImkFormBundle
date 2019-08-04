<?php


namespace Imk\FormBundle;


use Imk\FormBundle\Factory\Builder\FormBuilder;
use Imk\FormBundle\Factory\Form\FormProcess;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class ImkForm implements ImkFormInterface
{

    /**
     * @var FormProcess
     */
    private $formProcess;

    public function __construct(FormProcess $formProcess)
    {
        $this->formProcess = $formProcess;
    }

    public function formProcess(string $namespace, Request $request): FormInterface
    {
        $this->formProcess->formProcess($namespace, $request);
    }
}