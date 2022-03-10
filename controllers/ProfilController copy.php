<?php
require_once("../models/UserModel.php");

var_dump($_SESSION['user'][0]['login']);

class  ProfilController
{
    public $prenom;
    public $nom;
    public $login;
    public $email;
    public $password;
    public $id_droits;
    private $model;
    protected $bdd;

    public function __construct()
    {
        $this->model = new userModel;
    }

    public function update($prenom,$nom,$login,$email,$password,$passwordConfirm,$id_droits)
    {

        $id_droits = 3;
        $prenom = htmlspecialchars(trim(strtolower($prenom))); 
        $nom = htmlspecialchars(trim(strtolower($nom)));
        $login = htmlspecialchars(trim(strtolower($login))); 
        $email = htmlspecialchars(trim(strtolower($email))); 
        $password = htmlspecialchars(trim(strtolower($password))); 
        $passwordConfirm = htmlspecialchars(trim(strtolower($passwordConfirm))); 

        if(!empty($prenom) && !empty($nom) && !empty($login) && !empty($email) && !empty($password) && !empty($passwordConfirm))
        {
            $login_len = strlen($login);
            $password_len = strlen($password);

            if($login_len >= 3 && $password_len >= 3)
            {
               // $sameLoginUsers = $this->model->getUserByLogin($login); //users qui portent le meme login
               // $sameEmailUsers = $this->model->getUserByEmail($email); //users qui portent le meme email
            
               // if(($sameLoginUsers[0] !== $_SESSION['user'][0]['login'])) // "si n'existe aucun autre user portant le meme login"
               // {   
                  //  if(($sameEmailUsers[0] !== $_SESSION['user'][0]['email'])) // "si n'existe aucun autre user portant le meme email"
                   // {
                            if($password == $passwordConfirm)
                            {
                            $password = password_hash($password,PASSWORD_BCRYPT);

                            $this->model->updateUser($nom, $prenom, $email, $login, $id, $id_droits);
                            
                            header('Refresh:0');

                            }
                            else
                            {
                                return 'Les mots de passe doivent être identiques.';
                            }
                            
                   // }
                   // else
                   // {
                    //    return 'Ce email est déjà utilisé.';
                    }
             //   }else{
                //    return 'Ce login est déjà utilisé.';
             //   }

           // }
            else
            {
                return 'Votre login ou password est trop court';
            }


        }    
    }

}

