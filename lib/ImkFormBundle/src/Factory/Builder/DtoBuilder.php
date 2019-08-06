<?php


namespace Imk\FormBundle\Factory\Builder;


class DtoBuilder extends Builder
{
    /**
     * @var $data
     */
    private $name;

    /**
     *
     * @param string $name
     * @param        $dataRender
     *
     * @throws \Exception
     */
    public function build(string $name, $dataRender)
    {
        try {
            $this->name = $name;
            $this->generateDTO($this->getName(), $this->transformToValidator($this->parseValidator($dataRender)));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage().' - '.$e->getCode());
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        if (is_string($this->name) && $this->name !== '' && !is_null($this->name)) {
            $this->name = str_replace('Form', '', $this->name);
            $this->name = str_replace('Calculate', '', $this->name);
            $this->name = 'DtoForm'.ucfirst($this->name);

            return $this->name;
        }

        return '';
    }

    private function transformToValidator(array $validator)
    {
        if (is_array($validator)) {
            foreach ($validator as $key => $items) {
                foreach ($items as $realKey => $item) {
                    foreach ($item as $k => $i) {

                        if (strtolower($k) == 'notblank') {
                            $assertion = '@Assert\NotBlank'.(count($i) > 0) ? '("'.sprintf('%s', $i['message']).'")' : '';
                        }
                        if (strtolower($k) == 'notnull') {
                            $assertion = '@Assert\NotNull'.(count($i) > 0) ? '("'.sprintf('%s', $i['message']).'")' : '';
                        }

                        if (strtolower($k) == 'istrue') {
                            $assertion = '@Assert\IsTrue'.(count($i) > 0) ? '("'.sprintf('%s', $i['message']).'")' : '';
                        }
                        if (strtolower($k) == 'isfalse') {
                            $assertion = '@Assert\IsFalse'.(count($i) > 0) ? '("'.sprintf('%s', $i['message']).'")' : '';
                        }
                        if (strtolower($k) == 'istrue') {
                            $assertion = '@Assert\Email'.(count($i) > 0) ? '("'.sprintf('%s', $i['message']).'")' : '';
                        }
                        if (strtolower($k) == 'length') {
                            $assertion = '@Assert\Length(
                                            min=2,
                                            max=50,
                                            minMessage = "",
                                            maxMessage = ""    
                                        )';
                        }

                        if (strtolower($k) == 'date') {
                            $assertion = '@Assert\Date';
                        }

                        if (strtolower($k) == 'datetime') {
                            $assertion = '@Assert\DateTime';
                        }
                        if (strtolower($k) == 'language') {
                            $assertion = '@Assert\Language';
                        }

                        if (strtolower($k) == 'bic') {
                            $assertion = '@Assert\Bic';
                        }

                        if (strtolower($k) == 'iban') {
                            $assertion = '@Assert\Iban("'.sprintf('%s', $i['message']).'")';
                        }
                        if (strtolower($k) == 'isbn') {
                            $assertion = '@Assert\ISBN';
                        }

                    }
                }
            }
        }
    }

    private function parseValidator(array $dataRender)
    {
        if (is_array($dataRender)) {
            $result = [];
            foreach ($dataRender as $keys => $items) {
                $result[$keys] = $items['validation'];
            }

            return $result;
        }

        return [];
    }

}