<?php
session_start();
require_once('../controllers/ConnexionController.php');
require_once('include/header.php');
?>

<main>

    <h1>Accueil</h1>

    <p>Bonjour <?php $_SESSION['user']; ?>
</main>

<?php

require_once("include/footer.php");

?>

