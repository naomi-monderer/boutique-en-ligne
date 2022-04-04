<?php
require_once('../controllers/AdminController.php');
require_once('include/header.php');
$controller = new AdminController();

?>
<main>
    <section>
        <p>Voulez-vous vraiment supprimer l'utilisateur <?= 2;?></p>
        <form action="" method="get">
            <input type="text" name="oui" value="oui">
            <input type="text" name="non" value="non">
            </form>
    </section>    
</main>
<?php
