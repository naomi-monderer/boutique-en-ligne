<?php
require_once('../models/UserModel.php');
require_once('controllers/Controller.php');

class InscriptionController 
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
        // instencie un objet et on appelle l'une de ses méthodes
       $this->model =  new UserModel();
    }

    public function registers($prenom,$nom,$login,$email,$password,$passwordConfirm,$id_droits)
    {   
        $id_droits = 3;

      $seurity = $this->model->secureRegisters($prenom,$nom,$login,$email, $nom, $prenom,$email,$password,$passwordConfirm);


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

                            $this->model->insertUser($prenom,$nom,$login,$email,$password,$id_droits);
                            header('location: ../views/connexion.php');  
                        }
                        else
                        {
                            return 'Les mots de passe doivent être identiques.';
                        }
                        
                    }
                    else
                    {
                        return 'Ce email est déjà utilisé.';
                    }
                }else{
                    return 'Ce login est déjà utilisé.';
                }

            }
            else
            {
                return 'Votre login ou password est trop court';
            }
            // methodes de UserModel- verification du login et l'email uniques.

        }     
        else
        {
            return 'Tous les champs doivent être remplis.';
        }        
    }

}

