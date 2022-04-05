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
        $this->modelArticle = new ArticleModel;
        
    }
    //----------------GESTION DES USERS------------------------//
     public function modify($id,$nom, $prenom,$login, $email, $id_droits)
    {
           // verifier que le login en bdd est unique
        // verfier la longueur des login min 
        //  verififier que l'email est unique 
        

  
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
                if(($id_droits >= 1) && ($id_droits <=3))
                {
                    $checkUser = $this->model->getUserByLogin($login);
             
                    if(count($checkUser)  < 2 ) // Strictement inférieur à 2
                    {   
                        if(isset($checkUser[0]['id']) && ($id == $checkUser[0]['id']) || !isset($checkUser[0]['id']) ) 
                        // On modifie le meme detenteur du login counted
                        // si mon utilisateur existe et que l'id de l'input correspond bien à l'id récuperé par la requete 
                        // ou si mon utilisateur n'existe pas? --> tu peux update?
                        {
                            $modifyUser= $this->model->updateUser($id,$nom, $prenom, $email, $login,$id_droits);
                            $_SESSION['error'] = null;
                            unset($_SESSION['error']);
                            header("Location: admin_user.php");
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
                    $_SESSION['error'] = "les rôles pouvant être attribués sont compris entre 1 et 3.";
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


    //-----------------------AJOUTER ARTICLES OU OPTIONS (categorie, sous-categorie, auteur)---------------------//
    
    public function registerCategorie($nom_categorie)
    {
        if(!empty($nom_categorie))
        {   
            $nomCategorie = $this->modelCategorie->getCategorie($nom_categorie);
            echo "<pre>";
            var_dump($nomCategorie);
            echo "</pre>";
            if(count($nomCategorie) == 0)
            {
                $insertCategorie = $this->modelCategorie->insertCategorie($nom_categorie);
                $_SESSION['error'] = null;
                 unset($_SESSION['error']);
                // $_SESSION['error'] = $insertCategorie; // retour true or false de l'insertion
            }
            else
            {
                $_SESSION['error']= "Cette catégorie existe déjà."; 
            }
        }
        else
        {
            $_SESSION['error']= "Veuillez remplir le champs.";   
        }

        return $nomCategorie;
    }

    public function showAllCategoriesInNewCategory()
    {
        $getAllCategorie = $this->modelCategorie->allCategorie();
        return $getAllCategorie;
    }

  
    public function registerSousCategorie($nom_souscategorie, $id_categorie)
    {   
        if(!empty($nom_souscategorie))
        {   
            $resultSousCategories= $this->modelSousCategorie->getCategoriesByNameSousCategorie($id_categorie);
             $bool = true;
            foreach($resultSousCategories as $resultSousCategorie)
            {
                if($resultSousCategorie["nom_souscategorie"] == $nom_souscategorie){
                        
                        $bool = false;
                        $_SESSION['error'] = "Veuillez remplir le champs.";
                        var_dump('existe deja');
                }
            }
            if($bool == true)
            {
                $insertSousCategorie = $this->modelSousCategorie->insertSousCategorie($nom_souscategorie,$id_categorie);
            }
        }
        else{
            $_SESSION['error'] = "Veuillez remplir le champs.";
        }
        return $resultSousCategorie;
    }


    public function registerAuteur($nom,$prenom)
    {   
        if(!empty($nom) && !empty($prenom))
        {       
            $registerAuteur = $this->modelAuteur->insertAuteur($nom,$prenom);
        }

    }
    
  

    public function listCategories()
    {  
        $allCategories= $this->modelCategorie->innerCategoriesWithSousCategories();
       return $allCategories;
    }
    
    
    public function listAuteurs()
    { 
        $allAuteurs = $this->modelAuteur->getAllAuteurs();
        return $allAuteurs;
    }
    
    public function miseEnAvant()
    { 
         if(isset($_POST['mise_en_avant']) == 1)
        {
            $_POST['mise_en_avant'] == true;       
        }
    }
    
    public function registerArticle($titre,$description,$stock,$prix,$mise_en_avant,$editeur,$id_categorie,$id_souscategorie,$id_auteur,$image)
    {
        // if(!empty(trim($titre)) && !empty(trim($description)) && !empty(trim($stock)) && !empty(trim($prix)) && !empty(trim($mise_en_avant)) && !empty(trim($editeur)) && !empty($id_categorie) && !empty($id_souscategorie) && !empty(trim($id_auteur)) && !empty($image))
        // {
            $insertArticle=$this->modelArticle->insertArticle($titre,$description,$stock,$prix,$mise_en_avant,$editeur,$id_categorie,$id_souscategorie,$id_auteur,$image);
            // }
            // else
            // {
                //     $_SESSION['error'] = 'veuillez remplir ce champs. zrfstgzrtdgsf' ;
                // }
    }  
     //-----------------------/AJOUTER ARTICLES OU OPTIONS (categorie, sous-categorie, auteur)---------------------//

     //-----------------------MODIFIER OU SUPPRIMER DES ARTICLES OU DES OPTIONS-----------------------------------//
    public function modifyArticle($titre,$description,$stock,$prix,$mise_en_avant,$editeur,$id_categorie,$id_souscategorie,$id_auteur,$image)
    {
        $updateArticle=$this->modelArticle->updateArticle($titre,$description,$stock,$prix,$mise_en_avant,$editeur,$id_categorie,$id_souscategorie,$id_auteur,$image);
    }

    public function displayAllArticles()
    {
        $displayAllArticles = $this->modelArticle->getAllArticles();
    
        return $displayAllArticles;
    }
     //-----------------------/MODIFIER OU SUPPRIMER DES ARTICLES OU DES OPTIONS-----------------------------------//

     public function suppAuteur($id)
     {
         $suppAuteur = $this->modelAuteur->deleteAuteur($id);
     }

     public function suppCategorie($id)
     {
         $suppCategorie = $this->modelCategorie->deleteCategorie($id);
     }
     public function suppSousCategorie($id)
     {
         $suppSousCategorie = $this->modelSousCategorie->deleteSousCategorie($id);
     }

     public function suppArticle($id)
     {
        $suppArticle = $this->modelArticle->deleteArticle($id);
     }

     public function tabArticles()
     {
         $displayArticles = $this->modelArticle->InnerArticlesWithOptions();
         return $displayArticles;
     }

}
        































        // public function listSouscategories()
        // { 
        //     // $allSousCategories= $this->modelSousCategorie->
        // }
        
        ?>
 
 
 
 