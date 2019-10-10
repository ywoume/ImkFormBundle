<?php


namespace Imk\AuthBundle\Interfaces;


interface UsersAdvancedInterface extends UsersInterface
{

    public function startValidate();

    public function endValidate();

    public function addDayValidate();

    public function addSessionHistory();

}
