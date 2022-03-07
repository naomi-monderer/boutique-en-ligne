<?php
ob_start();
require_once('../controllers/AdminController.php');
require_once('include/header.php');
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
                    var_dump($allUser); ?>
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

if (isset($_GET['nom']) && !empty($_GET['nom']))
{   
    $id = $_GET['idHidden'];
    $nom= strip_tags($_GET['nom']);
    $modifyUser = $controller->modifynom($id, $nom);
}


if (isset($_GET['prenom']) && !empty($_GET['prenom']))
{   
    $id = $_GET['idHidden'];
    $prenom= strip_tags($_GET['prenom']);
    $modifyUser = $controller->modifyprenom($id, $prenom);
}


if (isset($_GET['email']) && !empty($_GET['email']))
{   
    $id = $_GET['idHidden'];
    $email= strip_tags($_GET['email']);
    $modifyUser = $controller->modifyemail($id, $email);
}


if (isset($_GET['login']) && !empty($_GET['login']))
{   
    $id = $_GET['idHidden'];
    $login= strip_tags($_GET['login']);
    $modifyUser = $controller->modifylogin($id, $login);
}


if (isset($_GET['id_droits']) && !empty($_GET['id_droits']))
{   
    $id = $_GET['idHidden'];
    $id_droit= strip_tags($_GET['id_droits']);
    $modifyUser = $controller->modifyid_droit($id, $id_droits);
}

    // echo '<pre>';
    // var_dump($_GET);
    // echo '</pre>';
    // evite les failles xss
    // $prenom= strip_tags($_GET['prenom']);
    // $email = strip_tags(filter_var($_GET['email'], FILTER_VALIDATE_EMAIL));
    // var_dump($email);
    // $login = strip_tags($_GET['login']);
    // $id_droits = strip_tags($_GET['id_droits']);

  



if(isset($_GET['delete']))
{ if(isset($_GET['idHidden']))
    {
        $id = $_GET['idHidden'];
        var_dump($id);
        $deleteUser= $controller->delete($id);
    }
}

if(isset($_GET['back']))
{
    header('location: admin.php');
}

ob_end_flush();
?>