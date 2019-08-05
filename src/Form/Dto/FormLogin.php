<?php

namespace App\Form\Dto;

    
            
/**
* DTO class for FormLogin.
* By odiceeRobot.
*/
class FormLogin
{

    /**
    *  @var text
    *
    */
    private $name;

    /**
    *  DTO getter for field name.
    */
    public function getName()
    {
    return $this->name;
    }

    /**
    * DTO setter for field name.
    */
    public function setName($name)
    {
    return $this->name = $name;
    }



}
