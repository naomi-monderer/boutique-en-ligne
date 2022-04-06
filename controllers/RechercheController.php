<?php
session_start();
require_once("../models/RechercheModel.php"); 


if(isset($_GET['search']) && !empty($_GET['search']))
{
    $search = htmlspecialchars($_GET['search']);

    
    $Recherche = new Recherche();
    //unset($_SESSION['search']); // supprime la valeur de la recherche
    $_SESSION['search'] = $Recherche->rechercheProduitsBySearch($_GET['search']);

    //var_dump($_SESSION);
   header('location: ../views/recherche.php');
}