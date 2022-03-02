<?php
session_start();
require_once('../controllers/ConnexionController.php');
require_once('include/header.php');
$controller = new UserModel;

var_dump($_SESSION['user']);
// if(($_SESSION['user'])
// {
  
// }

?>

