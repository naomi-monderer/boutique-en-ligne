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
            // var_dump($allUser['nom']);
            ?>

                <form action="" method="get">
                    <tr>
                        <td>
                            <input type="text" name="id" value="<?=$allUser['id'];?>">
                        </td>
                        <td>
                            <input type="text" name="nom" value="<?=$allUser['nom'];?>">
                        </td>
                        <td>
                            <input type="text" name="prenom" value="<?=$allUser['prenom'];?>">
                        </td>
                        <td>
                        <input type="text" name="login" value="<?=$allUser['login'];?>">
                        </td>    
                        <td>
                            <input type="text" name="email" value="<?=$allUser['email'];?>">
                        </td>
                        <td>
                            <input type="text" name="id_droits" value="<?=$allUser['id_droits'];?>">
                        </td>
                    
                        <td>
                            <input type="submit" name="update" value="Modifier">  
                        </td>
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
        //  $id= $user[0]['id'];
         $delete = $this->model->deleteUser($id);
         header('location: admin_user.php');
  
    }

  
}
?>