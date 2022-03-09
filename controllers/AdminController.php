<?php
require_once('../models/UserModel.php');
require_once('../models/ArticleModel.php');
require_once('Controller.php');

class AdminController extends Controller
{

    public function __construct()
    {
        $this->model = new UserModel;
        
    }

    public function showAllUsers()
    {   
        $allUsers = $this->model->findAllUsers();

        echo '<pre>';
        echo '</pre>';
       
        foreach($allUsers as $allUser)
        {          
            echo '<pre>';
            // var_dump($allUser);
            echo '</pre>';
            ?> 
            <tr>
                    <form action="" method="POST">
                        <td>
                            <p><?=$allUser['id'];?></p>
                        </td>
                        <td>
                            <input type="text" name="nom" value="<?=$allUser['nom'];?>">
                        </td>
                        <td>
                            <input type="text" name="prenom" value="<?=$allUser['prenom'];?>">      
                        </td>
                        <td>
                            <input type="text" name="email" value="<?=$allUser['email'];?>">      
                        </td>
                        <td>
                            <input type="text" name="login" value="<?=$allUser['login'];?>">
                        </td> 
                        <td>
                           
                            <input type="text" name="id_droits" value="<?=$allUser['id_droits'];?>">
                        </td>
                        <td>
                            <input type="submit" name="modify_user" value="modifier" >  
                            <input type="hidden" name="idHidden_user" value="<?=$allUser['id'];?>" > 
                        </td>
                    </form>
                    <form action="admin_user.php" method="get">
                        <td>
                                <input type="submit" name="delete_user" value="supprimer" >  
                                <input type="hidden" name="idHidden_user" value="<?=$allUser['id'];?>" > 
                            </td>
                    </form>

                  
                    </tr>
        
        <?php  
        }

            if(isset($_POST['delete_user']))
            {   
                    $id = $_POST['idHidden_user'];
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
               
            if(isset($_POST['modify_user']))
            {
                $id = $_POST['idHidden_user'];
                $users = $this->model->findUserById($id);
               
               
                $modify = $this->modify($id,$_POST['nom'],$_POST['prenom'], $_POST['login'], $_POST['email'],intval($_POST['id_droits']));
                // header('location: admin_user.php');
            }
    }
    

    public function modify($id,$nom, $prenom,$login, $email, $id_droits)
    {
           // verifier que le login en bdd est unique
        // verfier la longueur des login min 
        //  verififier que l'email est unique 
        //  id_droits soit <=1 et >=3)
      
        // $id = $user[0]['id'];
  
        // 
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
                $checkUserByLogin = $this->model->getUserByLogin($login);
                echo "<pre>";
                var_dump($checkUserByLogin[0]['login']);
                echo "</pre>";
               
                
                if($checkUserBylogin)
                {   
                   
                    // header('location: admin_user.php');
                    $_SESSION['error'] = 'Le login est déjà utilisé, veuillez en choisir un autre.'; 
                    var_dump('ok');
                }
                else
                {
                    var_dump('non');
                    $modifyUser= $this->model->updateUser($id,$nom, $prenom, $email, $login,$id_droits);
                    $_SESSION['error'] = null;
                    unset($_SESSION['error']);
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
}

?>
 <!-- $users = $this->model->findUserById($id);
            if(!empty($users))
            {   
                $login_len = strlen($login);
                $password_len = strlen($password);

                if($login_len >= 3 && $password_len >= 3)
                {
                    $sameLoginUsers = $this->model->getUserLogin($login);
                    $sameEmailUsers = $this->model->getUserByEmail($email);
                    if(empty($sameLoginUsers[0]))
                    {

                      
                    }
                    else
                    {
                        $_SESSION['error'] = 'Ce login est déjà utilisé.';
                    }
                }
                else
                {
                    $_SESSION['error'] = 'Le login ou le mot de passe est trop court.';
                }
            }
            else
            {
                $_SESSION['error'] = 'Cet utilisateur n\'existe pas.';
                header('location: admin_user.php');
            } -->