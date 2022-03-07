<?php
require('../models/UserModel.php');

class Controller
{
    public function __construct()
    {
        $this->model = new UserModel();
        // est ce que je peux instancier plusieurs classes dans mon construct?
        // d'ou vient $this->model déjà?
        // $this->model = new CommentModel();
    }

    public function secureRegisters($login,$nom,$prenom,$email,$password,$passwordConfirm)
    {
        $login = htmlspecialchars(trim($login)); 
        $nom = htmlspecialchars(trim(strtolower($nom))); 
        $prenom = htmlspecialchars(trim(strtolower($prenom))); 
        $email = htmlspecialchars(trim(strtolower($email))); 
        $password = htmlspecialchars(trim($password)); 
        $passwordConfirm = htmlspecialchars(trim($passwordConfirm)); 
    }
    public function secureModifyAdmin($login,$nom, $prenom, $email, $id_droits)
    {

        $login = htmlspecialchars(trim($login)); 
        $nom = htmlspecialchars(trim(strtolower($nom))); 
        $prenom = htmlspecialchars(trim(strtolower($prenom))); 
        $email = htmlspecialchars(trim(strtolower($email))); 
        $id_droits = htmlspecialchars(trim(is_int($id_droits))); 
       
    }
}




  