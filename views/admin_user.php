<?php
ob_start();
require_once('../controllers/AdminController.php');
require_once('include/header.php');
$controller = new AdminController();


?>
<main>
    </section>
    <section>
        <h1>Affichage des utilisateurs</h1>
        <table>
            <thead>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Login</th>
            <th>Email</th>
            <th>Id_droits</th>
            <th>MODIFIER</th>
            <th>SUPPRIMER</th>
            </thead>
            <tbody>
              
                <?php $allUser = $controller->showAllUsers(); ?>
            </tbody>    
        </table>
    </section>
</main>
<?php
// if (isset($_GET['update']))
// {
//    header('location: admin_user.php');
// }
if(isset($_GET['delete']))
{ if(isset($_GET['idHidden']))
    {
        $id = $_GET['idHidden'];
    
        var_dump($id);
        $supprimer = $controller->delete($id);
        echo "yeah";
        
    }
    // else
    // { 
    //     echo "suppression impossible";
    // }
}

ob_end_flush();
?>