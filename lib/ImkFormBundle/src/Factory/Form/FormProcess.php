<?php


namespace Imk\FormBundle\Factory\Form;


use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class FormProcess
{
    private $formBuilder;

    private $errors;
    /**
     * @var FormInterface
     */
    private $form;
    /**
     * @var Request
     */
    private $request;
    private $data;

    public function __construct(FormFactory $builder)
    {
        $this->formBuilder = $builder;

    }

    public function formProcess(string $namespace, Request $request)
    {
        $this->request = $request;
        $classMapping = \stdClass::class;
        $this->form = $this->formBuilder->create($namespace, $classMapping, [

        ]);

        return $this->validateForm();
    }

    public function validateForm() : bool
    {
        $this->form->handleRequest($this->request);
        if($this->form->isSubmitted() && $this->form->isValid()){
            //dto :

            return true;
        }
        return false;
    }

    public function formData()
    {
        return $this->data = $this->form->getData();
    }


    public function errors()
    {
        return $this->errors = $this->form->getErrors();
    }
}