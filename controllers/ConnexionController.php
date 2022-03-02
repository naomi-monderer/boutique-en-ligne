<?php
require("../models/UserModel.php");
<<<<<<< HEAD

class  ConnexionController
{   
    public $login;
    public $password;
    protected $bdd;


    public function __construct()
=======
// $bdd = new BddConnexion("localhost","boutique","root","");
// $pdo= $bdd->connexion();
// $utilisateur = new Utilisateur($pdo);
// $login = security($_POST["login"]);

class User
{
    public function connexion()
>>>>>>> 848cc49ec0b5460b34f36b2bb263baaa655fca61
    {
        $this->model = new UserModel;
    }

    public function connexion($login,$password)
    {   
        $login = htmlspecialchars(trim(strtolower($login)));
        $password = htmlspecialchars(trim(strtolower($password)));

        if(!empty($login) && !empty($password))
        {
            $sameLoginUsers = $this->model->getUserByLogin($login);

            if(!empty($sameLoginUsers[0]))
            {   $AllUserInfos = $this->model->getUserByLogin($login);
                $passwordHash = $AllUserInfos[0]['password'];
                // $var_dump($AllUserInfos);

                if(password_verify($password,$passwordHash))
                {
                    $_SESSION['user']= $AllUserInfos;
                    // var_dump($_SESSION['user']);
                      header('location: index.php');
                }
            }
            else
            {
                return ' login n\'est pas connu.';
            }
        }
        else
        {

            echo  " les champs doivent etre remplis";

        }

        


    }
}



?>