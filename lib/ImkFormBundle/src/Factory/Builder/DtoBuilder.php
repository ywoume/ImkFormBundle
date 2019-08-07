<?php


namespace Imk\FormBundle\Factory\Builder;


class DtoBuilder extends Builder
{
    /**
     * @var $data
     */
    private $name;
    /**
     * @var string
     */
    private $className;
    /**
     * @var string
     */
    private $formName;

    /**
     *
     * @param string $formName
     * @param string $className
     * @param array  $fieldsData
     *
     * @throws \Exception
     */
    public function build(string $formName, string $className, array $dataForRenderDto)
    {
        try {

            $this->className = $className;
            $this->formName = $formName;
            $this->generateDTO(
                $this->getClassName(),
                $dataForRenderDto,
                $this->transformToValidator($this->parseValidator($dataForRenderDto)),
                $this->parseAddMethod()
            );

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage().' - '.$e->getCode());
        }
    }

    /**
     * @return string
     */
    private function getClassName(): string
    {
        if (is_string($this->className) && $this->className !== '' && !is_null($this->className)) {
            $this->className = str_replace('Form', '', $this->className);
            $this->className = str_replace('Calculate', '', $this->className);
            $this->className = 'DtoForm'.ucfirst($this->className);

            return $this->className;
        }

        return '';
    }

    private function getFormName(): string
    {
        if (is_string($this->formName) && $this->formName !== '' && !is_null($this->formName)) {
            return $this->formName;
        }

        return '';
    }

    private function transformToValidator(array $validator): array
    {
        if (is_array($validator)) {
            $assertion = [];
            foreach ($validator as $key => $items) {
                foreach ($items as $realKey => $item) {
                    foreach ($item as $k => $i) {

                        if (strtolower($k) == 'notblank') {
                            $assertion[$key][] = (count($i) > 0) ? '@Assert\NotBlank'.'("'.sprintf('%s', $i['message']).'")' : '@Assert\NotBlank';

                        }
                        if (strtolower($k) == 'number' || strtolower($k) == 'positive' || strtolower($k) == 'integer') {
                            $assertion[$key][] = (count($i) > 0) ? '@Assert\Positive'.'("'.sprintf('%s', $i['message']).'")' : '@Assert\Positive';
                        }

                        if (strtolower($k) == 'notnull') {
                            $assertion[$key][] = (count($i) > 0) ? '@Assert\NotNull'.'("'.sprintf('%s', $i['message']).'")' : '@Assert\NotNull';
                        }

                        if (strtolower($k) == 'email') {
                            $assertion[$key][] = (count($i) > 0) ? '@Assert\Email'.'("'.sprintf('%s', $i['message']).'")' : '@Assert\Email';
                        }

                        if (strtolower($k) == 'istrue' || strtolower($k) == 'true') {
                            $assertion[$key][] = (count($i) > 0) ? '@Assert\True'.'("'.sprintf('%s', $i['message']).'")' : '@Assert\True';
                        }

                        if (strtolower($k) == 'isfalse' || strtolower($k) == 'false') {
                            $assertion[$key][] = (count($i) > 0) ? '@Assert\False'.'("'.sprintf('%s', $i['message']).'")' : '@Assert\False';
                        }

                        if (strtolower($k) == 'type') {
                            $assertion[$key][] = '@Assert\Type(type="'.sprintf('%s', $i['type']).'" , message="'.sprintf('%s', $i['message']).'"';
                        }

                        if (strtolower($k) == 'length') {
                            $assertion[$key][] = '@Assert\Length(min="'.sprintf('%s', $i['min']).'", max="'.sprintf('%s', $i['max']).'", minMessage="'.sprintf(
                                    '%s',
                                    $i['minMessage']
                                ).'", maxMessage="'.sprintf('%s', $i['maxMessage']).'")';
                        }

                        if (strtolower($k) == 'less' || strtolower($k) == 'lessthan') {
                            $assertion[$key][] = '@Assert\LessThan("'.sprintf('%s', $i['value']).'")';
                        }
                        if (strtolower($k) == 'greather' || strtolower($k) == 'greatherthan') {
                            $assertion[$key][] = '@Assert\GreaterThan("'.sprintf('%s', $i['value']).'")';
                        }

                        if (strtolower($k) == 'date') {
                            $assertion[$key][] = '@Assert\Date';
                        }
                        if (strtolower($k) == 'datetime') {
                            $assertion[$key][] = '@Assert\DateTime';
                        }

                        if (strtolower($k) == 'bic') {
                            $assertion[$key][] = '@Assert\Bic';
                        }
                        if (strtolower($k) == 'iban') {
                            $assertion[$key][] = (count($i) > 0) ? '@Assert\Iban'.'("'.sprintf('%s', $i['message']).'")' : '@Assert\Iban';
                        }
                        if (strtolower($k) == 'iban') {
                            $assertion[$key][] = (count($i) > 0) ? '@Assert\Iban'.'("'.sprintf('%s', $i['message']).'")' : '@Assert\Iban';
                        }

                    }
                }

            }

            return $assertion;
        }

        return [];
    }

    private function parseValidator(array $dataRender)
    {

        if (is_array($dataRender)) {
            $result = [];
            foreach ($dataRender as $keys => $items) {
                foreach ($items as $kItem => $itemItems) {
                    $result[$kItem] = $itemItems['validation'];
                }
            }
            return $result;
        }

        return [];
    }

    private function parseAddMethod()
    {
        $form = $this->loadConfigFactory->getForm($this->getFormName());
        if (array_key_exists('addMethod', $form)) {
            return $form['addMethod']['method'];
        }

        return [];
    }

    /*private function parseUniqueFields()
    {
        return  $this->loadConfigFactory->getForm($this->getFormName())['unique'];

    }*/

}