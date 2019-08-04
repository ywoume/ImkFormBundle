<?php


namespace Imk\FormBundle\Factory\Form;


use Imk\FormBundle\Factory\LoadConfigFactory;

class Form
{
    protected $isEntity;

    protected $fields;

    protected $formAction;

    protected $isLogin;

    protected $class;

    protected $config;

    protected $provider;

    protected $currentForm;

    protected $name;


    public function __construct(LoadConfigFactory $loadConfigFactory)
    {
        $this->config = $loadConfigFactory;

    }

    public function allForms()
    {
       return $this->config->getForms();
    }

    public function getForm(string $name)
    {
         $this->currentForm = $this->config->getForm($name);
         return $this;
    }

    public function getClass()
    {
        return $this->currentForm['class'];
    }

    public function getAction()
    {
        return $this->formAction = $this->currentForm['action'];
    }

    public function getProvider()
    {
        return $this->currentForm['provider'];
    }

    public function getAttr() : array
    {
        return $this->currentForm['attr'];
    }
    public function getName() : string
    {
        return $this->currentForm['name'];
    }

    public function getFields()
    {
        return $this->currentForm['fields'];
    }

    public function isLogin() : bool
    {
        return $this->isLogin  =$this->currentForm['login'];
    }
}