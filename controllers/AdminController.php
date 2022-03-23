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


    //-----------------------GESTION DES ARTICLES---------------------//
    
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
        else    
        
        {
            $_SESSION['error'] = "Veuillez remplir le champs.";
        }
        return $resultSousCategorie;
    }

    public function registerAuteur($nom,$prenom)
    {   /* 
        je ne veux pas qu'on puisse rentrer plusieurs fois les même auteur en bdd.
         je dois comparer les champs de mes post au niveau du nom et du prenom 
         avec ce que j'ai en base de données. 
         en base données dans auteurs j'ai 3 champs. 
         --------------------------------------------------------
         je veux qu
        
        */
        if(!empty($nom) && !empty($prenom))
        {       
            // $getAuteurs = $this->modelAuteur->getAllAuteurs();
           
            // foreach($getAuteurs as $getAuteurs)
            // {
            //         $getAuteurs;
            //         var_dump($getAuteurs);
            // }
            $getAuteursById = $this->modelAuteur->getAuteursById($id);
            var_dump($getAuteursById);
           
            // if(isset($auteur['nom']) && isset($auteur['prenom']) )
            // {
            //     $_SESSION['error'] = "Veuillez remplir le champs.";
            // }
            // else
            // {
            //     $insertAuteur = $this->modelAuteur->insertAuteur($nom,$prenom);
            // }

  
        }

    }
    


}

?>
 


            