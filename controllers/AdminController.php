<?php
require_once('../models/UserModel.php');
require_once('../models/ArticleModel.php');
require_once('../models/CategorieModel.php');
require_once('../models/SousCategorieModel.php');
require_once('../models/AuteurModel.php');
require_once('Controller.php');

class AdminController extends Controller
{

    public function __construct()
    {
        $this->model = new UserModel;
        $this->modelCategorie = new CategorieModel;
        $this->modelSousCategorie = new SousCategorieModel;
        $this->modelAuteur = new AuteurModel;
        
    }
    //--------------------------GESTION DES USERS------------------------//
     public function modify($id,$nom, $prenom,$login, $email, $id_droits)
    {
           // verifier que le login en bdd est unique
        // verfier la longueur des login min 
        //  verififier que l'email est unique 
        //  id_droits soit <=1 et >=3)
      
        // $id = $user[0]['id'];
  
        $nom = $this->secure(strtolower($nom)); 
        $prenom = $this->secure(strtolower($prenom)); 
        $email = $this->secureEmail(strtolower($email));
        $login = $this->secure($login);
        $id_droits = $this->secure(intval($id_droits));
    
        if(!empty($nom) && !empty($prenom) && !empty($email) && !empty($login) && !empty($id_droits))
        {   
            $login_len = strlen($login);
      

            if($login_len >= 3)
            {    
                
                $checkUser = $this->model->getUserByLogin($login);
             
                if(count($checkUser)  < 2 ) // Strictement inférieur a 2
                {   
                    if(isset($checkUser[0]['id']) && ($id == $checkUser[0]['id']) || !isset($checkUser[0]['id']) ) // On modifie le meme detenteur du login counted
                    {
                        $modifyUser= $this->model->updateUser($id,$nom, $prenom, $email, $login,$id_droits);
                        $_SESSION['error'] = null;
                        unset($_SESSION['error']);
                    }
                    else
                    {
                        $_SESSION['error'] = 'trop meta pour moi';              
                    }
                }
                else
                {
                    $_SESSION['error'] = 'Le login est déjà utilisé, veuillez en choisir un autre.'; 
                    header('location: admin_user.php');
                }
               
            }
            else
            {
                $_SESSION['error'] = 'Le login ou le mot de passe est trop court.'; 
            }

           
            
        }
        else
        {
            $_SESSION['error'] = "Tous les champs doivent être remplis.";

        }
    }

    public function displayUsers()
    {
        $allUsers = $this->model->findAllUsers();
        return $allUsers;
    }

    public function suppUser($id)
    {
        $users = $this->model->findUserById($id);
        if(!empty($users))
        {   
            $deleteUser= $this->model->deleteUser($id);
            header('location: admin_user.php');
         
        }
        else
        {
            $_SESSION['error'] = "Cet utilisateur n'existe pas.";
            header('location: admin_user.php');
        }
    }


    //-----------------------GESTION DES ARTICLES---------------------//
    
    public function registerCategorie($nom_categorie)
    {
        var_dump('SUR PP controller');
        $insertCategorie = $this->modelCategorie->insertCategorie($nom_categorie);
        // $_SESSION['error'] = $insertCategorie; // retour true or false de l'insertion
    }

    public function showAllCategoriesInNewCategory()
    {
        $getAllCategorie = $this->modelCategorie->allCategorie();
        return $getAllCategorie;
    }

    public function registerSousCategorie($nom_souscategorie, $id_categorie)
    {

        // $getCategorie = $this->modelCategorie->getCategorie($id);
        // // $id = $id_categorie; 
        // var_dump($getCategorie);
        $insertSousCategorie = $this->modelSousCategorie->insertSousCategorie($nom_souscategorie,$id_categorie);
    }

    public function registerAuteur($nom,$prenom)
    {
        $insertAuteur = $this->modelAuteur->insertAuteur($nom,$prenom);
    }
    


}

?>
 


            