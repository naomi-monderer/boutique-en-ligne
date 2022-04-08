<?php


class Controller
{
    // protected $model;
    // protected $modelName;
    // protected $articleController;
    // protected $userController;
    // public    $message;
    // public    $messagePass;

    public function __construct()
    {

    }

    public function secure($value)
    {
        
        $value = htmlspecialchars(trim(strip_tags($value))); 
        return $value;
    }

    public function secureEmail($email)
    {
        $email = htmlspecialchars(trim(strip_tags(filter_var($email,FILTER_VALIDATE_EMAIL)))); 
        return $email;
    }

    
  
}




  