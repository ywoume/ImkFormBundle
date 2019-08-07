<?php


namespace Imk\FormBundle\Utils;


use Imk\FormBundle\Factory\Builder\Builder;
use Imk\FormBundle\Factory\Builder\DtoBuilder;
use Imk\FormBundle\Factory\Builder\FormBuilder;
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
     * @var DtoBuilder
     */
    private $builderForm;
    /**
     * @var Form
     */
    private $form;


    /**
     * ImkCmdManager constructor.
     * @param Form $form
     * @param FormFields $formFields
     * @param DtoBuilder $builderDto
     * @param FormBuilder $builderForm
     */
    public function __construct(Form $form, FormFields $formFields, DtoBuilder $builderDto, FormBuilder $builderForm)
    {
        $this->formFields = $formFields;
        $this->builderDto = $builderDto;
        $this->builderForm = $builderForm;
        $this->form = $form;
    }

    /**
     * @param $allForms
     *
     * @throws \Exception
     */
    public function buildDto($allForms)
    {

        if(is_array($allForms)){
            foreach ($allForms as $formName => $allForm) {
                $dataForRenderDto = $this->formFields->fields($formName)->buildDataRenderDto();
                $className = $this->form->getClass();
                try {
                    $this->builderDto->build($formName, $className, $dataForRenderDto);
                } catch (\Exception $e) {
                    throw new \Exception("Bug de du builder dto");
                }
            }
        }

    }
    public function buildForm($allForms)
    {
        if(is_array($allForms)){
            foreach ($allForms as $formName => $allForm) {
                $dataForRenderForm = $this->formFields->fields($formName)->buildDataRenderForm();
                $className = $this->form->getClass();
                $this->builderForm->build($className, $this->formFields->getFields(), $dataForRenderForm);
            }
        }

    }

    public function allForms()
    {
        return $this->form->allForms();
    }
}