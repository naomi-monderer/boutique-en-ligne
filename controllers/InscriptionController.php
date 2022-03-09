<?php
require_once('../models/UserModel.php');
require_once('Controller.php');

class InscriptionController extends Controller
{   
    public $prenom;
    public $nom;
    public $login;
    public $email;
    public $password;
    private $model;
    protected $bdd;

    public function __construct()
    {
      
       $this->model =  new UserModel();
    
    }

    public function registers($prenom,$nom,$login,$email,$password,$passwordConfirm,$id_droits)
    {   
        $id_droits = 3;
       
    
        $login = $this->secure($login);
        $nom =$this->secure(strtolower($nom)); 
        $prenom =$this-> secure(strtolower($prenom)); 
        $email =$this-> secure(strtolower($email)); 
        $password =$this-> secure($password); 
        $passwordConfirm =$this-> secure($passwordConfirm); 


        if(!empty($prenom) && !empty($nom) && !empty($login) && !empty($email) && !empty($password) && !empty($passwordConfirm))
        {   
            $login_len = strlen($login);
            $password_len = strlen($password);

            if($login_len >= 3  && $password_len >= 3)
            {
                $sameLoginUsers = $this->model->getUserByLogin($login); //users qui portent le meme login
                $sameEmailUsers = $this->model->getUserByEmail($email); //users qui portent le meme email

                if(empty($sameLoginUsers[0])) // "s'il n'existe aucun user portant le meme login"
                {   
                    if(empty($sameEmailUsers[0])) // "s'il n'existe aucun user portant le meme email"
                        {
                            if($password == $passwordConfirm)
                        {
                            $password = password_hash($password,PASSWORD_BCRYPT);
                            $_SESSION['error'] = null;
                            $this->model->insertUser($nom,$prenom,$email,$password,$login,$id_droits);
                            header('location: ../views/connexion.php');  
                        }
                        else
                        {
                            $_SESSION['error'] = 'Les mots de passe doivent être identiques.';
                        }
                        
                    }
                    else
                    {
                        $_SESSION['error'] = 'Ce email est déjà utilisé.';
                    }
                }else{
                    $_SESSION['error'] = 'Ce login est déjà utilisé.';
                }

            }
            else
            {
                $_SESSION['error'] = 'Ce login ou ce mot de passe est trop court.';
            }
        }     
        else
        {
            $_SESSION['error'] = 'Tous les champs doivent être remplis.';
        }        
    }

}

