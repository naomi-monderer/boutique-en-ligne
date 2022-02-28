<?php
require ('../models/UserModel.php');


class UserController

{   
    public $prenom;
    public $nom;
    public $login;
    public $email;
    public $password;
    private $model;
    private $bdd;

    public function __construct()
    {
        // instencie un objet et on appelle l'une de ses méthodes
       $model = $this->model =  new UserModel();
        $this->bdd = $this->model->connect();
    
        // var_dump($this->connect);

            
    }

    public function registers($prenom,$nom,$login,$email,$password,$passwordConfirm)
    {   
        
       
        $login = htmlspecialchars(trim($login)); 
        $nom = htmlspecialchars(trim($nom)); 
        $prenom = htmlspecialchars(trim($prenom)); 
        $email = htmlspecialchars(trim($email)); 
        $password = htmlspecialchars(trim($password)); 
        $passwordConfirm = htmlspecialchars(trim($passwordConfirm)); 

  //      $login_len = strlen($login);

//        if($login_len < 4 && $nom_len ...)
             
        if(!empty($prenom) && !empty($nom) && !empty($login) && !empty($email) && !empty($password) && !empty($passwordConfirm))
        {   
            $loginResult = $this->model->checkLogin($login);
            if(count($loginResult) == 0)
            {
                if($password == $passwordConfirm)
                {
                    $password = password_hash($password,PASSWORD_BCRYPT);
                    // a
                    $this->model->insertUser($prenom,$nom,$login,$email,$password);
                }
                else
                {
                    return 'mot de passe pas égal';
                }
            }
            else
            {
                return 'Ce login est déjà utilisé';
            }
        }
        else
        {
            return 'Les champs sont vides';
        }        
    }

}



