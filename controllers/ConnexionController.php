<?php
require_once("../models/UserModel.php");
require_once('Controller.php');


class  ConnexionController extends Controller
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
        $login = $this->secure(strtolower($login));
        $password = $this->secure($password);

    
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
                return 'Ce login n\'est pas correct.';
            }
        }
        else
        {

            echo  "Tous les champs doivent etre remplis";

        }

        


    }
}



?>