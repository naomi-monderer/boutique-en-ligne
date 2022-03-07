<?php
require_once('../controllers/AdminController.php');
require_once('include/header.php');
?>
<main>
    <section>
        <h1>Espace Administratif</h1>
            <article>
                    <article>
                        <h2>Gestion des utilisateurs</h2>
                        <form action="" method="get">
                            <input type="submit" name="display_user" value="Afficher les utilisateurs">
                        </form>

                    </article>
                    <article>
                        <h2>Gestion des articles</h2>
                        <form action="" method="get">
                            <input type="submit" name="display_article" value="Afficher les articles">
                        </form>
                       
                    </article>    
            </article>
         
</main>
<?php   
if(isset($_GET['display_article']))
{
    header('location: admin_article.php');
}
if(isset($_GET['display_user']))
{ 
    header('location: admin_user.php');
}
?>