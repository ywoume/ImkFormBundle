<?php


namespace Imk\FormBundle\Utils;


use Imk\FormBundle\Factory\Builder\Builder;
use Imk\FormBundle\Factory\Builder\DtoBuilder;
use Imk\FormBundle\Factory\Form\Form;
use Imk\FormBundle\Factory\Form\FormFields;

class ImkCmdManager
{

    /**
     * @var FormFields
     */
    private $formFields;
    /**
     * @var Builder
     */
    private $builder;
    /**
     * @var DtoBuilder
     */
    private $builderDto;
    /**
     * @var Form
     */
    private $form;


    /**
     * ImkCmdManager constructor.
     * @param Form $form
     * @param FormFields $formFields
     * @param DtoBuilder $builder
     */
    public function __construct(Form $form, FormFields $formFields, DtoBuilder $builder)
    {
        $this->formFields = $formFields;
        $this->builderDto = $builder;
        $this->form = $form;
    }

    public function buildDto($allForms)
    {

        if(is_array($allForms)){
            foreach ($allForms as $formName => $allForm) {
                $dataForRenderDto = $this->formFields->fields($formName)->buildDataRenderDto();
                $className = $this->form->getClass();
                $this->builderDto->build($className, $this->formFields->getFields(), $dataForRenderDto);
            }
        }

    }

    public function allForms()
    {
        return $this->form->allForms();
    }
}