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
    {   // 
        $nom = $this->secure(ucwords($nom)); 
        $prenom = $this->secure(ucwords($prenom)); 
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
        
        $nom_categorie =$this->secure(strtoupper($nom_categorie));
        if(!empty($nom_categorie))
        {   
            $nomCategorie = $this->modelCategorie->getCategorie($nom_categorie);

           
            if(count($nomCategorie) == 0)
            {
                $insertCategorie = $this->modelCategorie->insertCategorie($nom_categorie);
                // $_SESSION['error'] = '<p style=color:green;>enregistrement de la catégorie réussi.</p>';
                //  unset($_SESSION['error']);
            
            }

            else
            {
                return "<p style=color:red;> Cette catégorie existe déjà.</p>"; 
            }
            // return $nomCategorie;
        }
        else
        {
            return "<p style=color:red;>Veuillez remplir le champs.<p style=color:red;>";   
        }
    }

    public function showAllCategoriesInNewCategory()
    {
        $getAllCategorie = $this->modelCategorie->allCategorie();
        return $getAllCategorie;
    }


    public function registerSousCategorie($nom_souscategorie, $id_categorie)
    {   
        $nom_souscategorie = $this->secure(ucwords($nom_souscategorie));
        
        if(!empty($nom_souscategorie))
        {   
            $resultSousCategories= $this->modelSousCategorie->getCategoriesByNameSousCategorie($id_categorie);
            
            $bool = true;
            
                foreach($resultSousCategories as $resultSousCategorie)
                {
                    if($resultSousCategorie["nom_souscategorie"] == $nom_souscategorie)
                    {
                            
                            // var_dump($resultSousCategorie["nom_souscategorie"],$nom_souscategorie);
                        
                            $bool = false;
                            return "<p style='color:red;'>Cette sous-categorie existe déjà.</p>";
                            // var_dump('existe deja');        
                    }
                }

                if($bool == true)
                {
                    $insertSousCategorie = $this->modelSousCategorie->insertSousCategorie($nom_souscategorie,$id_categorie);
                    // $_SESSION['error']= "";
                    
                    return "<p style='color:green;'>enregistrement réussi</p>";
                } 
        }
        else
        {
            return "<p style='color:red;'> Veuillez remplir le champs.</p>";
        }
    }


    public function registerAuteur($nom,$prenom)
    { 
        $nom =$this->secure(ucwords($nom));
        $prenom =$this->secure(ucwords($prenom));

        if(!empty($nom) && !empty($prenom))
        {      
            $registerAuteur = $this->modelAuteur->insertAuteur($nom,$prenom);
        }
        else
        {
            return "<p style='color:red;'> Veuillez remplir les champs.</p>";
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
        // else
        // {
        //     $_POST['mise_en_avant'] == false;
        // }
    }
        
    public function registerArticle($titre,$description,$stock,$prix,$mise_en_avant,$editeur,$id_categorie,$id_souscategorie,$id_auteur,$image)
    {   
        $titre = $this->secureWithoutTrim($titre);
        $description= $this->secureWithoutTrim($description);
        $stock = $this->secure($stock);
        $prix = $this->secure($prix);
        // $mise_en_avant = $this->secure(intval($mise_en_avant));
        $editeur = $this->secureWithoutTrim($editeur);
        $id_categorie = $this->secure(intval($id_categorie));
        $id_souscategorie = $this->secure(intval($id_souscategorie));
        $id_auteur = $this->secure(intval($id_auteur));
        $image = $this->secure($image);
    
        if(!empty($titre) && !empty($description) && !empty($prix) && !empty($editeur) && !empty($id_categorie) && !empty($id_souscategorie) && !empty($id_auteur) && !empty($image))
        {   
            $description_len = strlen($description);
            if($description_len <= 500)
            { 
                if($stock > 0)
                {   
                    if($prix > 0)
                    {   
                        $url_len = strlen($image); 
                        if($url_len <= 500)
                        {
                            $insertArticle=$this->modelArticle->insertArticle($titre,$description,$stock,$prix,$mise_en_avant,$editeur,$id_categorie,$id_souscategorie,$id_auteur,$image);
                        }
                        else
                        {
                            return '<p style= color:red;>L\'adresse URL doit être inférieure à 500 caractères.</p>';
                        }
                    }
                    else
                    {
                        return  '<p style= color:red;>Le prix ne peut pas être égal à 0.</p>';
                    }
                }
                else
                {
                    return  '<p style= color:red;>Le montant du stock est invalide.</p>';
                }
            }
            else
            {
                return  '<p style= color:red;>La description doit être inférieure à 500 caractères.</p>';
            }
        }
        else
        {
            return  '<p style= color:red;>Veuillez remplir tous les champs.</p>';   
        }  
    }

        //-----------------------/AJOUTER ARTICLES OU OPTIONS (categorie, sous-categorie, auteur)---------------------//

        //-----------------------MODIFIER DES ARTICLES -----------------------------------//
        
    public function modifyArticle($id,$titre,$description,$stock,$prix,$mise_en_avant,$editeur,$id_categorie,$id_souscategorie,$id_auteur,$image)
    {   
        $titre = $this->secureWithoutTrim($titre);
        $description= $this->secureWithoutTrim($description);
        $stock = $this->secure(intval($stock));
        $prix = $this->secure($prix);
        $mise_en_avant = $this->secure(intval($mise_en_avant));
        $editeur = $this->secureWithoutTrim($editeur);
        $id_categorie = $this->secure(intval($id_categorie));
        $id_souscategorie = $this->secure(intval($id_souscategorie));
        $id_auteur = $this->secure(intval($id_auteur));
        // $image = $this->secure($image);
        echo '<pre>';
        // var_dump($id,$titre,$description,$stock,$prix,$mise_en_avant,$editeur,$id_categorie,$id_souscategorie,$id_auteur,$image);
        echo '</pre>';
        if(!empty($titre) && !empty($description) && !empty($prix) && !empty($mise_en_avant) && !empty($editeur) && !empty($id_categorie) && !empty($id_souscategorie) && !empty($id_auteur) && !empty($image))
        {   
                $description_len = strlen($description);
                if($description_len <= 500)
                {  
                    if($stock > 0)
                    {   
                        
                        if($prix > 0)
                        {   
                            $url_len = strlen($image); 
                            if($url_len <= 500)
                            { 
                                $modifyArticle = $this->modelArticle->updateArticle($id,$titre,$description,$stock,$prix,$mise_en_avant,$editeur,$id_categorie,$id_souscategorie,$id_auteur,$image);
                                header("Location: admin_update_article.php?idHidden_article=$id");
                            }
                            else
                            {
                                return '<p style= color:red;>L\'adresse URL doit être inférieure à 500 caractères.</p>';
                            }
                        }
                        else
                        {
                            return  '<p style= color:red;>Veuillez indiquer un montant supérieur à 0.</p>';
                        }
                    }
                    else
                    {
                        return  '<p style= color:red;>Le montant du stock est invalide. Il doit etre supérieur a 0</p>';
                    }
                }
                else
                {
                    return  '<p style= color:red;>La description doit être inférieure à 500 caractères.</p>';
                }
        }
        else
        {
        return  '<p style= color:red;>Veuillez remplir tous les champs.</p>';   
        }  
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

    //------------------------MODIFIER DES OPTIONS---------------------------------------------------//
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

    public function modifyCategorie($id,$nom_categorie)
    {
        $nom_categorie = secureWithoutTrim(strtoupper($nom_categorie));
        if (!empty($nom_categorie))
        {   
            $result = $this->modelCategorie->getOneValue('categories','nom_categorie',$nom_categorie);
        
            if(count($result) == 0)
            {
                $modifyCategorie = $this->modelCategorie->updateCategorie($id,$nom_categorie);
                header('Location: admin_manage_other_forms.php');
                // return  "La catégorie a été modifié en:". $nom_categorie;
            }
            else
            {
                return '<p style = color:red;> Cette Catégorie existe déjà.</p>';
            }
        }
        else
        {
            return '<p style = color:red;> Veuillez remplir le champs.</p>';
        }
    }

    public function modifySousCategorie($id,$id_categorie,$nom_souscategorie)
    {   
        $nom_souscategorie = ucwords($nom_souscategorie);

        if (!empty($nom_souscategorie))
        {   
            $bool= true;
            $result = $this->modelSousCategorie->selectAllWhere("nom_souscategorie",'souscategories','id_categorie',$id_categorie); 
            // echo '<pre>';
            // var_dump($result);
            // echo '</pre>';
            
            foreach($result as $res)
            {   
                if($res['nom_souscategorie'] == $nom_souscategorie)
                {   
                    // var_dump($nom_souscategorie,$res['nom_souscategorie']);
                    $bool== false;
                    return '<p style = color:red;> Cette sous-catégorie existe déjà pour cette catégorie.</p>';
                }
            }    
            if($bool == true)
            {
                $modifySouscategorie = $this->modelSousCategorie->updateSousCategorie($id,$nom_souscategorie);
                // return 'l\'enregistrement de la sous-catégorie a bien été pris en compte.';
                header('Location: admin_manage_other_forms.php');
            }
        }
        else
        {
            return '<p style = color:red;> Veuillez remplir le champs correspondant à la sous-catégorie.</p>';
        }
    }

    public function modifyAuteur($id,$nom,$prenom)
    {   
        $nom = ucwords($nom);
        $prenom = ucwords($prenom);
        // var_dump($nom,$prenom);
        if(!empty($nom) && !empty($prenom))
        {   
            $modifyAuteur = $this->modelAuteur->updateAuteur($id,$nom,$prenom);
            header('Location: admin_manage_other_forms.php');
        }
        else
        {
            return '<p style = color:red;> Veuillez renseigner le nom ou le prénom de l\'auteur.ice dans le champs vide.</p>';
        }
    }
}
?>
 
 
 
 