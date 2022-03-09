<?php
ob_start();
require_once('include/header.php');
require_once('../controllers/AdminController.php');


$controller = new AdminController();
$allUser = $controller->showAllUsers();
$allUsers = $controller->displayUsers();


?>
<main>
    <section>
        <article>
            <h1>Affichage des utilisateurs</h1>
            <table>
                <thead>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Login</th>
                <th>Id_droits</th>
                
                <th>MODIFIER</th>
                <th>SUPPRIMER</th>
                </thead>
                <tbody>
                    <?php
                 
                    foreach($allUsers as $allUser)
                        {          
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
                    <?php } ?>
                </tbody>    
            </table>
        </article>

        <article>
            <form action="" method="get">
                <input type="submit" name="back" value="retourner au menu de gestion">
            </form>
        </article>
    </section>
</main>

<?php
if(isset($_SESSION['error']))
{
    echo "<div>" . $_SESSION['error'] . "</div>";
}

if(isset($_GET['back']))
{
    header('location: admin.php');
}
ob_end_flush();
?>