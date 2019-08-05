<?php

namespace App\Form\Dto;

    
                
                
                
            
/**
* DTO class for FormInscription.
* By odiceeRobot.
*/
class FormInscription
{

    /**
    *  @var text
    *
    */
    private $nom;

    /**
    *  @var text
    *
    */
    private $prenom;

    /**
    *  @var repeated
    *
    */
    private $password;

    /**
    *  @var email
    *
    */
    private $email;

    /**
    *  DTO getter for field nom.
    */
    public function getNom()
    {
    return $this->nom;
    }

    /**
    * DTO setter for field nom.
    */
    public function setNom($nom)
    {
    return $this->nom = $nom;
    }



    /**
    *  DTO getter for field prenom.
    */
    public function getPrenom()
    {
    return $this->prenom;
    }

    /**
    * DTO setter for field prenom.
    */
    public function setPrenom($prenom)
    {
    return $this->prenom = $prenom;
    }



    /**
    *  DTO getter for field password.
    */
    public function getPassword()
    {
    return $this->password;
    }

    /**
    * DTO setter for field password.
    */
    public function setPassword($password)
    {
    return $this->password = $password;
    }



    /**
    *  DTO getter for field email.
    */
    public function getEmail()
    {
    return $this->email;
    }

    /**
    * DTO setter for field email.
    */
    public function setEmail($email)
    {
    return $this->email = $email;
    }



}
