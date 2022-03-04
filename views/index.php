<?php
require_once('../controllers/ConnexionController.php');
require_once('include/header.php');
$controller = new ConnexionController();

?>

<main>

    <h1>Accueil</h1>

    <?php
    
    if(!empty($_SESSION)) {

        echo '<p>Bonjour : ' . $_SESSION['user'][0]['prenom'] .''. $_SESSION['user'][0]['nom'] . '</p>';
    } else {

        echo 'non connecte';
    }

    var_dump($_SESSION['user'][0]);
    ?>

</main>

<?php

require_once("include/footer.php");

?>
<main>