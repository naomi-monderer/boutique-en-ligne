<?php
require_once("../models/UserModel.php");
require_once("../controllers/Controller.php");

class  ProfilController extends Controller
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

    public function recupId($id)
    {
        $datasUser = $this->model->findUserById($id);
        return $datasUser;
        
        var_dump($datasUser[0]);
    }
 
    public function modifyLogin($login)
    {
        $login = htmlspecialchars(trim(strtolower($login))); 

        $id = $_SESSION['user'][0]['id'];
        $login_len = strlen($login);


            if($login_len >= 3)
            {
                $sameLoginUsers = $this->model->getUserByLogin($login); //users qui portent le meme login

                if(empty($sameLoginUsers) && $login != $_SESSION['user'][0]['login']) // "s'il n'existe aucun user portant le meme login"
                {

                    $this->model->updateLogin($id, $login);

                    $AllUserInfos = $this->model->getUserByLogin($login);
                   // $var_dump($AllUserInfos);

                   $_SESSION['user'] = $AllUserInfos;

                    
                    header('Location: ../views/profil');
                }
                   
                else
                {

                    $_SESSION['error'] = 'Ce login est déjà utilisé.';
                }    
            }

    }

    public function modifyEmail($email)
    {
        $email =$this->secureEmail(strtolower($email)); 

        $id = $_SESSION['user'][0]['id'];

        $sameEmailUsers = $this->model->getUserByEmail($email); //users qui portent le meme email

        if(empty($sameEmailUsers) && $email !== $_SESSION['user'][0]['email'])
        {

            $this->model->updateEmail($id, $email);

            $AllUserInfos = $this->model->getUserByEmail($email);


           $_SESSION['user'] = $AllUserInfos;
           var_dump($_SESSION);

            
           header('Location: ../views/profil');
        }
           
        else
        {

            $_SESSION['error'] = 'Cet email est déjà enregistré.';
        }    
    }

    public function modifyPassword($password, $passwordConfirm)
    {
        $password =$this-> secure($password); 
        $passwordConfirm =$this-> secure($passwordConfirm); 

        $id = $_SESSION['user'][0]['id'];

        if($password == $passwordConfirm)
        {
            $password = password_hash($password,PASSWORD_BCRYPT);

            $this->model->updatePassUser($id, $password);

            header('Location: ../views/profil');
        }

        else
        {
            $_SESSION['error'] = 'Les mots de passe doivent être identiques.';
        }
    }

}

