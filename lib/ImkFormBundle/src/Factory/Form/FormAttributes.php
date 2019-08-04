<?php


namespace Imk\FormBundle\Factory\Form;


class FormAttributes
{
    protected $formClass;

    protected $formId;

    /**
     * @return mixed
     */
    public function getFormClass()
    {
        return $this->formClass;
    }

    /**
     * @return mixed
     */
    public function getFormId()
    {
        return $this->formId;
    }


}