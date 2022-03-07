<?php
require_once('../models/UserModel.php');
require('../models/ArticleModel.php');

class AdminController 
{

    public function __construct()
    {
        $this->model = new UserModel;
        
    }

    public function showAllUsers()
    {   
        $allUsers = $this->model->findAllUsers();
        echo '<pre>';
        // var_dump($allUsers);
        echo '</pre>';
       
        foreach($allUsers as $allUser)
        {        
            echo '<pre>';
            // var_dump($allUser);
            echo '</pre>';
            ?>

            <!-- <form action="" method="get"> -->
                    <tr>
                        <td>
                            <p><?=$allUser['id'];?></p>
                          
                        </td>
                        
                        <td>
                        <form action="" method="get">
                            <input type="text" name="nom" value="<?=$allUser['nom'];?>">
                            <input type="hidden" name="idHidden" value="<?=$allUser['id'];?>" > 
                            <input type="submit" name="update" value="Modifier">
                        </form>    
                        </td>
                        <td>
                        <form action="" method="get">
                            <input type="text" name="prenom" value="<?=$allUser['prenom'];?>">
                            <input type="hidden" name="idHidden" value="<?=$allUser['id'];?>" > 
                            <input type="submit" name="update" value="Modifier">
                        </form>        
                        </td>
                          
                        <td>
                        <form action="" method="get">
                            <input type="text" name="email" value="<?=$allUser['email'];?>">
                            <input type="hidden" name="idHidden" value="<?=$allUser['id'];?>" > 
                            <input type="submit" name="update" value="Modifier">
                        </form>        
                        </td>

                        <td>
                        <form action="" method="get">
                        <input type="text" name="login" value="<?=$allUser['login'];?>">
                        <input type="hidden" name="idHidden" value="<?=$allUser['id'];?>" > 
                        <input type="submit" name="update" value="Modifier">
                        </form>    
                        </td> 
                        
                        <td>
                        <form action="" method="get">
                            <input type="text" name="id_droits" value="<?=$allUser['id_droits'];?>">
                            <input type="hidden" name="idHidden" value="<?=$allUser['id'];?>" > 
                            <input type="submit" name="update" value="Modifier">
                        </form>        
                        </td>
                    
                        <!-- <td>
                            <input type="submit" name="update" value="Modifier">
                            <input type="hidden" name="idHidden" value="<?=$allUser['id'];?>" > 
                        </td> -->
                        </form>
                        <td>
                            <form action="admin_user.php" method="get">
                                <input type="submit" name="delete" value="supprimer" >  
                                <input type="hidden" name="idHidden" value="<?=$allUser['id'];?>" > 
                            </form>
                        </td>
                    </tr>
            <?php            
        }
    }


    public function delete($id)
    {   
         $user = $this->model->findUserById($id); 
         var_dump($user);
         $delete = $this->model->deleteUser($id);
         header('location: admin_user.php');
        // créer une page delete_user " êtes vous sur de vouloir supprimer cet utilisateurs" en faisant voyager l'id du user dans l'url"
    }

    public function modify($id,$nom, $prenom,$login, $email, $id_droits)
    {
           // verifier que le login en bdd est unique
        // verfier la longueur des login min 
        //  verififier que l'email est unique 
        //  id_droits soit <=1 et >=3)
        // $user = $this->model->findUserById($id); 
        // $id = $user[0]['id'];
            $modify= $this->model->updateUser($id,$nom, $prenom,$email,$login, $id_droits);
            header('location: admin_user.php');
        // header('location: admin_user.php');
    //     if(!empty($login) && !empty($nom) && !empty($prenom) && !empty($email) && !empty($password))
    //     {   
    //         if()
    //         {

    //         }
    //     }
    //     else
    //     {
    //         return "Tous les champs doivent être remplis.";
    //     }


    }
    public function modifynom($id, $nom)
    {
        $modify= $this->model->updateUsers($id,'nom',$nom);
        header('location: admin_user.php');
        exit;
    }

    public function modifyprenom($id, $prenom)
    {
        $modify= $this->model->updateUsers($id,'prenom',$prenom);
        header('location: admin_user.php');
        exit;
    }

    public function modifyemail($id, $email)
    {
        $modify= $this->model->updateUsers($id,'email',$email);
        header('location: admin_user.php');
        exit;
    }

    public function modifylogin($id, $login)
    {
        $modify= $this->model->updateUsers($id,'login',$login);
        header('location: admin_user.php');
        exit;
    }

    public function modifyId_droits($id, $id_droits)
    {
        $modify= $this->model->updateUsers($id,'id_droits',$id_droits);
        header('location: admin_user.php');
        exit;
    }
  
}

?>