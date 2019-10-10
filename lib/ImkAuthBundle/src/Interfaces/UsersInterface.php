<?php


namespace Imk\AuthBundle\Interfaces;


use Symfony\Component\Security\Core\User\UserInterface;

interface UsersInterface extends UserInterface
{

    public function getEnabled();

    public function getToken();

    public function getUpdatedAt();
}
