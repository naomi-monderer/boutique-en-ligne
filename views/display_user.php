<?php
require_once('../controllers/AdminController.php');
$controller = new AdminController();
$allUser = $controller->showAllUsers();

?>
<main>
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
            <th>SUPPRIMER</th>
            </thead>
            <tbody>
                <form action="" method="get">
                    <tr>

                    </tr>
                </form>

            </tbody>    
        </table>
    </section>
</main>    