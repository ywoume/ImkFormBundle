<?php


namespace Imk\FormBundle\Factory\Form;


use Doctrine\Common\Collections\ArrayCollection;
use Imk\FormBundle\Factory\LoadConfigFactory;
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

class FormFields
{

    private $name;

    private $template;

    private $dto;

    private $validation;

    private $class;

    private $id;

    private $type;

    private $require;

    private $event;

    private $dataHtml = [];

    private $dataFieldRender;
    private $currentForm;
    private $fields;
    private $entity;
    private $attr;

    public function __construct(Form $form)
    {
        $this->currentForm = $form;
        $this->validation = new ArrayCollection();
        $this->dataHtml = new ArrayCollection();
        $this->event = new ArrayCollection();
    }

    public function buildDataRender() : array
    {

        if(is_array($this->fields)){
            $result = [];
            foreach ($this->fields as $item => $field) {
                $this->matchFields($field);
            }
            return $result;
        }
        return [];

    }

    public function buildDataRenderDto()
    {
        if(is_array($this->fields)){
            $result = [];
            foreach ($this->fields as $item => $field) {
                if($field['dto']){
                    $result[] = $this->matchFields($field);
                }
            }
            return $result;

        }
        return [];
    }

    private function matchFields($field)
    {
        $this->name = $field['name'];
        $this->template = $field['template'];
        $this->dto = $field['dto'];
        $this->entity = $field['entity'];
        $this->validation = $field['validation'];
        $this->attr = (array_key_exists('attr', $field) ? $field['attr'] : null);
        $this->event = $field['event'];
        $result[$this->name]['config'] = [
            'isTemplate' => $this->template,
            'isDto' => $this->dto,
            'isValidation' => (count($this->validation) > 0 ) ? true : false,
            'isEntity' => $this->entity,
        ];

        $result[$this->name]['attr'] = [
            'class' => $this->attr['class'],
            'id' => $this->attr['id'],
            'type' => $this->attr['type'],
            'require' => $this->attr['require'],
        ];
        if($result[$this->name]['config']['isValidation']){
            $validation = [];
            foreach ($this->validation as $k => $item) {
                $validation[] = $item;
            }
            $result[$this->name]['validation'] = $validation;
        }
        return $result;
    }

    public function getName()
    {
        return $this->currentForm->getName();
    }

    public function getFields()
    {
        return $this->currentForm->getFields();
    }
    protected function matchType()
    {

    }

    public function fields(string $formName)
    {
       $this->fields = $this->currentForm->getForm($formName)->getFields();
       return $this;
    }
    /**
     * @param array $fields
     * @return array
     */
    private function buildFieldForm(array $fields): array
    {
        $result = [];
        foreach ($fields as $key => $item) {
            if ($item['type'] == 'int') {
                $result[$item['name']] = $this->verifyAttributeKeys($item, IntegerType::class);
            }
            if ($item['type'] == 'number') {
                $result[$item['name']] = $this->verifyAttributeKeys($item, NumberType::class);
            }
            if ($item['type'] == 'float') {
                $result[$item['name']] = $this->verifyAttributeKeys($item, NumberType::class);
            }
            if ($item['type'] == 'text') {
                $result[$item['name']] = $this->verifyAttributeKeys($item, TextType::class);
            }
            if ($item['type'] == 'textarea') {
                $result[$item['name']] = $this->verifyAttributeKeys($item, TextareaType::class);
            }

            if ($item['type'] == 'string') {
                $result[$item['name']] = $this->verifyAttributeKeys($item, TextType::class);
            }

            if ($item['type'] == 'varchar') {
                $result[$item['name']] = $this->verifyAttributeKeys($item, TextType::class);
            }

            if ($item['type'] == 'date') {
                $result[$item['name']] = $this->verifyAttributeKeys($item, DateType::class);
            }

            if ($item['type'] == 'datetime') {
                $result[$item['name']] = $this->verifyAttributeKeys($item, DateTimeType::class);
            }

            if ($item['type'] == 'country') {
                $result[$item['name']] = $this->verifyAttributeKeys($item, CountryType::class);
            }

            if ($item['type'] == 'language') {
                $result[$item['name']] = $this->verifyAttributeKeys($item, LanguageType::class);
            }

            if ($item['type'] == 'time') {
                $result[$item['name']] = $this->verifyAttributeKeys($item, LanguageType::class);
            }

            if ($item['type'] == 'currency') {
                $result[$item['name']] = $this->verifyAttributeKeys($item, CurrencyType::class);
            }

            if ($item['type'] == 'file') {
                $result[$item['name']] = $this->verifyAttributeKeys($item, FileType::class);
            }

            if ($item['type'] == 'checkbox') {
                $result[$item['name']] = $this->verifyAttributeKeys($item, CheckboxType::class);
            }

            if ($item['type'] == 'choice') {
                $result[$item['name']] = $this->verifyAttributeKeys($item, ChoiceType::class);
            }

            if ($item['type'] == 'bool') {
                $result[$item['name']] = $this->verifyAttributeKeys($item, CheckboxType::class);
            }

            if ($item['type'] == 'radio') {
                $result[$item['name']] = $this->verifyAttributeKeys($item, RadioType::class);
            }


            if ($item['type'] == 'phone') {
                $result[$item['name']] = $this->verifyAttributeKeys($item, TelType::class);
            }

            if ($item['type'] == 'repeat') {
                $result[$item['name']] = $this->verifyAttributeKeys($item, RepeatedType::class);
            }

            if ($item['type'] == 'email') {
                $result[$item['name']] = $this->verifyAttributeKeys($item, EmailType::class);
            }

            if ($item['type'] == 'password') {
                $result[$item['name']] = $this->verifyAttributeKeys($item, PasswordType::class);
                // $result[] = $this->verifyAttributeKeys($item);
            }
            if ($item['type'] == 'image') {
                $result[$item['name']] = $this->verifyAttributeKeys($item, FileType::class);
                // $result[] = $this->verifyAttributeKeys($item);
            }
        }

        return $result;
    }



    private function verifyAttributeKeys($item, $type)
    {
        return [
            'type' => $type,
            'value' => (array_key_exists('value', $item)) ? $result['value'] = $item['value'] : $result['value'] = null,
            'emmy' => (array_key_exists('emmy', $item)) ? $result['emmy'] = $item['emmy'] : $result['emmy'] = null,
            'name' => (array_key_exists('name', $item)) ? $result['name'] = $item['name'] : $result['name'] = null,
        ];
    }
}