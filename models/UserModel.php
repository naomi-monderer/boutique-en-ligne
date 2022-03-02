<?php
require_once('Model.php');


class UserModel extends Model
{
    protected $id;
    public $prenom;
    public $nom;
    public $login;
    public $email;
    protected $table = "User"; 
    

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

    public function getUserByLogin($login) 
    {   
       
        $requete = "SELECT * FROM utilisateurs WHERE login = :login ";
        $result = $this->connect()->prepare($requete);
        $result->bindValue(':login', $login);
        $result->execute();
        $checkUser = $result->fetchAll(PDO :: FETCH_ASSOC);
        
        // var_dump($checkUser);
        
        return $checkUser;
     
    }

    public function getUserByEmail($email)
    {   
       
        $requete = "SELECT * FROM utilisateurs WHERE email = :email";
        $result = $this->connect()->prepare($requete);
        $result->bindValue(':email', $email);
        $result->execute();
        $checkUser = $result->fetchAll(PDO :: FETCH_ASSOC);
        
        var_dump($checkUser);
        
        return $checkUser;
     
    }

    
    public function findUser($id) :array 
    {   $this->id = $id;
        $requete = "SELECT * FROM utilisateurs WHERE id = :id";
        $result = $this->connect()->prepare($requete);
        $result->execute(array(':id' => $id));
        $dataUser = $result->fetchAll(PDO :: FETCH_ASSOC);
        return $dataUser;
    }
    
}