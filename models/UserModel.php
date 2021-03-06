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
    
    public function insertUser($nom,$prenom,$email,$password,$login,$id_droits)
    {
       //Insert les utilisateurs en bdd
        $requete = $this->connect()->prepare("INSERT INTO utilisateurs(nom,prenom,email,password,login,id_droits) VALUES (:nom,:prenom,:email,:password,:login,:id_droits)");
        $requete->execute(array(
            ":nom"=> $nom,
            ":prenom" => $prenom,
            ":email" => $email,
            ":password" => $password,
            ":login" => $login,
            ":id_droits" => $id_droits,
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
        
        //var_dump($checkUser);
        
        return $checkUser;
     
    }

    public function findUserById($id) :array
    {   #$this->id = $id;
        $requete = "SELECT * FROM utilisateurs WHERE id = :id";
        $result = $this->connect()->prepare($requete);
        $result->execute(array(':id' => $id));
        $dataUser = $result->fetchAll(PDO :: FETCH_ASSOC);

        return $dataUser;
    }
    
    public function findAllUsers()
    {
     
        $requete = "SELECT * FROM utilisateurs";
        $result = $this->connect()->prepare($requete);
        $result->execute();
        $dataUser = $result->fetchAll(PDO :: FETCH_ASSOC);
        return $dataUser;
    }
    public function deleteUser($id)
    {
        $requete = "DELETE FROM utilisateurs WHERE id=:id";
        $result= $this->connect()->prepare($requete);
        $result->execute(array(':id'=> $id));

    }

     public function updateUser($id,$nom, $prenom, $email, $login,$id_droits)
    {   
       $requete = "UPDATE `utilisateurs` SET `nom`=:nom,`prenom`=:prenom,`email`=:email,`login`=:login, `id_droits`=:id_droits WHERE `id` = :id";
       $result = $this->connect()->prepare($requete);
       $result->execute(array(
                                ':id' => intval($id), 
                                ':nom'=> $nom,
                                ':prenom'=> $prenom,
                                ':email'=> $email,
                                ':login'=> $login,
                                ':id_droits'=> intval($id_droits)
                            ));
    }

    public function updateLogin($id, $login)
    {  
        $requete = "UPDATE `utilisateurs` SET `login`= :login WHERE `id` = :id";
        $result = $this->connect()->prepare($requete);
        $result->execute(array(':id' => $id, ':login'=> $login));
    }

    public function updateEmail($id, $email)
    {  
        $requete = "UPDATE `utilisateurs` SET email = :email WHERE `id` = :id";
        $result = $this->connect()->prepare($requete);
        $result->execute(array(':id' => $id, ':email'=> $email));
    }

    public function updatePassUser($id, $password)
    {  
        $requete = "UPDATE `utilisateurs` SET password = :password WHERE `id` = :id";
        $result = $this->connect()->prepare($requete);
        $result->execute(array(':id' => $id, ':password'=> $password));
    }
}
?>