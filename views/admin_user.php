<?php
ob_start();
require_once('include/header.php');
require_once('../controllers/AdminController.php');


$controller = new AdminController();


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
                  <?php $allUser = $controller->showAllUsers();
                 ?>
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
// var_dump($_SESSION);

if(isset($_SESSION['error']))
{
    
    echo "<div>" . $_SESSION['error'] . "</div>";
  
}
// unset($_SESSION['error']);

    // echo '<pre>';
    // var_dump($_GET);
    // echo '</pre>';
    // evite les failles xss
   

  if(isset($_GET['back']))
{
    header('location: admin.php');
}
ob_end_flush();



?>