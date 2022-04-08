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
        // $nom_categorie =  ucwords($nom_categorie);
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
           
            }

            else
            {
                $_SESSION['error']= "Cette catégorie existe déjà."; 
            }
            return $nomCategorie;
        }
        else
        {
            $_SESSION['error']= "Veuillez remplir le champs.";   
        }
    }

    public function showAllCategoriesInNewCategory()
    {
        $getAllCategorie = $this->modelCategorie->allCategorie();
        return $getAllCategorie;
    }

  
    public function registerSousCategorie($nom_souscategorie, $id_categorie)
    {   
        // $nom_souscategorie = ucwords($nom_souscategorie);
        if(!empty($nom_souscategorie))
        {   
            $resultSousCategories= $this->modelSousCategorie->getCategoriesByNameSousCategorie($id_categorie);
                $bool = true;
            foreach($resultSousCategories as $resultSousCategorie)
            {
                if($resultSousCategorie["nom_souscategorie"] == $nom_souscategorie){
                        
                        $bool = false;
                        $_SESSION['error'] = "Cette sous-categorie existe déjà.";
                        var_dump('existe deja');
                        
                }
            }
            if($bool == true)
            {
                $insertSousCategorie = $this->modelSousCategorie->insertSousCategorie($nom_souscategorie,$id_categorie);
            } 
            return $resultSousCategorie;
        }
        else
        {
            $_SESSION['error'] = "Veuillez remplir le champs.";
        }
    }


    public function registerAuteur($nom,$prenom)
    { 
        //   $nom = ucwords($nom);
        // $prenom = ucwords($prenom);

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
    
    public function modifyArticle($id,$titre,$description,$stock,$prix,$mise_en_avant,$editeur,$id_categorie,$id_souscategorie,$id_auteur,$image)
    {
        $modifyArticle = $this->modelArticle->updateArticle($id,$titre,$description,$stock,$prix,$mise_en_avant,$editeur,$id_categorie,$id_souscategorie,$id_auteur,$image);
        return $modifyArticle;
    }

    public function displayAllArticles()
    {
        $displayAllArticles = $this->modelArticle->getAllArticles();
    
        return $displayAllArticles;
    }
     //-----------------------SUPPRIMER DES ARTICLES OU DES OPTIONS-----------------------------------//

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
        var_dump($id); 
        $suppArticle = $this->modelArticle->deleteArticle($id);

     }
      //-----------------------SUPPRIMER DES ARTICLES OU DES OPTIONS-----------------------------------//

     //-----------------------------MODIFIER DES ARTICLES OU DES OPTIONS-------------------------------//
                                            /* Articles */

     // permet d'afficher les articles dans admin_tab_articles.php
     public function tabArticles()
     {
         $displayArticles = $this->modelArticle->InnerArticlesWithOptions();
         return $displayArticles;
     }

    // permet de recuperer les articles dans admin_update_articles.php 
     public function Article($id)
     {
     
         $allArticles= $this->modelArticle->getArticle($id);
  
         return $allArticles;
         
     }
                                         /* Catégories */
     public function modifyCategorie($id,$nom_categorie)
     {
        if (!empty($nom_categorie))
        {   

            $modifyCategorie = $this->modelCategorie->updateCategorie($id,$nom_categorie);
        }
        else
        {
            $_SESSION['error']='Veuillez renseigner le nom de la nouvelle catégorie';
        }
         
         return $modifyCategorie;
     }
    
    public function modifyAuteur($id,$nom,$prenom)
    {   $nom = ucwords($nom);
        $prenom = ucwords($prenom);
        if(!empty($prenom) && !empty($prenom))
        {
            $modifyAuteur = $this->modelAuteur->updateAuteur($id,$nom,$prenom);
        }
        else
        {
            $_SESSION['error']='Veuillez renseigner le nom et le prénom de l\'auteur.ice';
        }
        return $modifyAuteur;
    }

    public function modifySousCategorie($id,$id_categorie,$nom_souscategorie)
    {   
        if (!empty($nom_souscategorie))
        {
            $result = $this->modelSousCategorie->selectAllWhere("nom_souscategorie",'souscategories','id_categorie',$id_categorie); 
            var_dump($result);
            $modifySouscategorie = $this->modelSousCategorie->updateSousCategorie($id,$nom_souscategorie);
            return $modifySouscategorie;
        }
        else
        {
            $_SESSION['error']='Veuillez renseigner le nom de la nouvelle sous-catégorie';
        }
       
    }
    
   

}
        































        // public function listSouscategories()
        // { 
        //     // $allSousCategories= $this->modelSousCategorie->
        // }
        
        ?>
 
 
 
 