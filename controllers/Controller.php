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
        // $this->model = new $this->modelName;
        // est ce que je peux instancier plusieurs classes dans mon construct?
        // d'ou vient $this->model déjà?
        // $this->model = new CommentModel();

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




  