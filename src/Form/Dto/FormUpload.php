<?php

namespace App\Form\Dto;

    
            
/**
* DTO class for FormUpload.
* By odiceeRobot.
*/
class FormUpload
{

    /**
    *  @var 
    *
    */
    private $pdf;

    /**
    *  DTO getter for field pdf.
    */
    public function getPdf()
    {
    return $this->pdf;
    }

    /**
    * DTO setter for field pdf.
    */
    public function setPdf($pdf)
    {
    return $this->pdf = $pdf;
    }



}
