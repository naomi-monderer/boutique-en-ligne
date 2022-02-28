<?php
require('../models/Bdd.php');


class UserModel extends Model
{
    public $prenom;
    public $nom;
    public $login;
    public $email; 
    

    public function __construct()
    {
        
    }
    
    
    public function insertUser($prenom,$nom,$login,$email,$password)
    {
       //Insert les utilisateurs en bdd
        $requete = $this->connect()->prepare("INSERT INTO utilisateurs(nom,prenom,email,password,login) VALUES (:nom,:prenom,:email,:password,:login)");
        $requete->execute(array(
            ":nom"=> $nom,
            ":prenom" => $prenom,
            ":email" => $email,
            ":password" => $password,
            ":login" => $login,
        ));
    }

    public function checkLogin($login)
    {   $this->login = $login;
       
        $requete = "SELECT login FROM utilisateurs WHERE login = :login";
        $result = $this->connect()->prepare($requete);
        $result->bindValue(':login', $this->login);
        $result->execute();
        $checkLogin = $result->fetchAll(PDO :: FETCH_ASSOC);
        // var_dump($result);
        return $checkLogin; $login = $this->login;  
        $checkLogin = $this->model->checkLogin($login);
        
    

    }
        
}