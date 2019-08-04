<?php


namespace Imk\FormBundle;


use Imk\FormBundle\Factory\Form\Form;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;

interface ImkFormInterface
{

    public function formProcess(string $namespace, Request $request) : FormInterface;
}