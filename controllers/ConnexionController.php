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
        $login = htmlspecialchars(trim($login));
        $password = htmlspecialchars(trim($password));

        if(!empty($login) && !empty($password))
        {
            $dataUser= $this->model->checkUser($login);
            // $verifLogin = 
            $verifLogin=$dataUser[0]['login'];
            var_dump($verifLogin);
          
            if(count(array($verifLogin)) == 1)
            {   
                $passwordHash = $dataUser[0]['password'];

                if(password_verify($password,$passwordHash))
                {
                    $_SESSION['user']= $dataUser;
                      header('location: index.php');
                }
            }
            else
            {
                return 'Ce login est inconnu.';
            }
        }
        else
        {

            echo  "tout les champs doivent etre remplis";
          
        }



    }
}


?>