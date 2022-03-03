<?php
require("../models/UserModel.php");

class  ConnexionController
{   
    public $login;
    public $password;
    protected $bdd;


    public function __construct()
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
                return 'Ce login n\'est pas connu.';
            }
        }
        else
        {

            echo  "tout les champs doivent etre remplis";

        }

        


    }
}



?>