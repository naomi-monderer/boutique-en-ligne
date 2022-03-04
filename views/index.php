<?php
require_once('../controllers/ConnexionController.php');
require_once('include/header.php');
$controller = new ConnexionController;
echo '<pre>';
var_dump($_SESSION['user']);
echo '</pre>';
?>
<main>
</main>    

