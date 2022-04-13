<?php
ob_start();
require_once('include/header.php');
require_once('../controllers/AdminController.php');


$controller = new AdminController();
$allUsers = $controller->displayUsers();
if(isset($_POST['delete_user']))
{   
    $id = $_POST['idHidden_user'];
    $supp = $controller->suppUser($id);
  

}
       
if(isset($_POST['modify_user']))
{
    $id = $_POST['idHidden_user'];
    // $users = $this->model->findUserById($id);
    
    // var_dump($_POST);
    $modify = $controller->modify($id,$_POST['nom'],$_POST['prenom'], $_POST['login'], $_POST['email'],intval($_POST['id_droits']));
    // header('location: admin_user.php');
}
if(isset($_SESSION['error']))
{
    echo "<div>" . $_SESSION['error'] . "</div>";
}

if(isset($_GET['back']))
{
    header('location: admin.php');
}

?>
<main class="main-bo">
<?php require_once('include/sideBar.php')?>
    <section class="contener-principal">
        <article class="titre-principal">
            <h1>AFFICHAGE DES UTILISATEURS</h1>
        </article>
        <article>
            <table class="content-table">
                <thead>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Login</th>
                <th>Id_droits</th>
            
                </thead>
                <tbody>
                    <?php
                 
                    foreach($allUsers as $allUser)
                        {          
                        ?> 
                            <tr>
                                <form class="form-bo" action="" method="POST">
                                    <td class="id-user">
                                        <p><?=$allUser['id'];?></p>
                                    </td>
                                    <td>
                                        <input class="input-medium" type="text" name="nom" value="<?=$allUser['nom'];?>">
                                    </td>
                                    <td>
                                        <input class="input-medium" type="text" name="prenom" value="<?=$allUser['prenom'];?>">      
                                    </td>
                                    <td>
                                        <input class="input-large" type="text" name="email" value="<?=$allUser['email'];?>">      
                                    </td>
                                    <td>
                                        <input class="input-medium" type="text" name="login" value="<?=$allUser['login'];?>">
                                    </td> 
                                    <td>
                                        
                                        <input class="input-small" type="text" name="id_droits" value="<?=$allUser['id_droits'];?>">
                                    </td>
                                    <td>
                                   
                                        <button class="butt-modif" type="submit" name="modify_user" ><i class="fa-solid fa-screwdriver-wrench"></i></button>
                                        <input type="hidden" name="idHidden_user" value="<?=$allUser['id'];?>" > 
                                    </td>
                                </form>
                                <form action="" method="post">
                                    <td>
                                     
                                        <button class="butt-delete" name="delete_user" type='submit'><i class="fa-solid fa-xmark"></i></button>  
                                        <input type="hidden" name="idHidden_user" value="<?=$allUser['id'];?>" > 
                                    </td>
                                </form>
                            </tr>
                    <?php } ?>
                </tbody>    
            </table>
        </article>

    </section>
</main>

<?php
require_once('include/footer.php');

ob_end_flush();
?>