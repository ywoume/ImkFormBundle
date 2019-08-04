<?php


namespace Imk\FormBundle\Factory\Builder;


class DtoBuilder extends Builder
{
    /**
     * @var $data
     */
    private $data;

    /**
     *
     * @param string $name
     * @param $fields
     * @param $dataRender
     * @throws \Exception
     */
    public function build(string $name, $fields, $dataRender): void
    {
        try {
            $this->generateDTO($name, $fields, $dataRender);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage() . ' - ' . $e->getCode());
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        if (is_array($this->data) && array_key_exists('name', $this->data)) {
            return $this->data['name']['className'];
        }
        return '';
    }

}