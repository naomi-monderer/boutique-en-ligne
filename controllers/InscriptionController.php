<?php
require ('../models/UserModel.php');

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

    public function registers($prenom,$nom,$login,$email,$password,$passwordConfirm)
    {   
        
       
        $login = htmlspecialchars(trim($login)); 
        $nom = htmlspecialchars(trim($nom)); 
        $prenom = htmlspecialchars(trim($prenom)); 
        $email = htmlspecialchars(trim($email)); 
        $password = htmlspecialchars(trim($password)); 
        $passwordConfirm = htmlspecialchars(trim($passwordConfirm)); 

  
             
        if(!empty($prenom) && !empty($nom) && !empty($login) && !empty($email) && !empty($password) && !empty($passwordConfirm))
        {   
            $login_len = strlen($login);
            $password_len = strlen($password);
     
            if($login_len >= 4  && $password_len >= 6)
            {
                $loginResult = $this->model->checkUser($login);
                
                if(count($loginResult) == 0)
                {             
                    $emailResult = $this->model->checkEmail($email);
                    var_dump($emailResult);
                    
                    if(count($emailResult) == 0)
                    {   
                        if($password == $passwordConfirm)
                        {
                            $password = password_hash($password,PASSWORD_BCRYPT);
                        
                            $this->model->insertUser($prenom,$nom,$login,$email,$password);
                            header('location: ../views/connexion.php');  
                        }
                        else
                        {
                            return 'Les mots de passe doivent être identiques.';
                        }
                    }
                    else
                    {
                        return 'Cet email est déjà utilisé.';
                    }
                }
                else
                {
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



// $login_len = strlen($login);
//             $password_len = strlen($password);
//             if($login_len < 4 && )
//             {
