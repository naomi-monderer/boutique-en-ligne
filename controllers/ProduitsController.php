<?php

// Verif categorie
if(!empty($_GET["id"])){
    require_once("../models/ProduitsModel.php"); 
    // ça buggait pcq y'avait deux fois le meme require dans la meme page
    // favorisez les require_once 
    // $route =  str_replace('views/articles.php','',$_SERVER['SCRIPT_FILENAME']);
    //var_dump($route);
  
    // require($route."models/Article.php");
    $produitModel = new ProduitsModel();
    $productById =$produitModel->getProductsById($_GET["id"]);

    // verif si c est pas vide sion erreur
    //var_dump($productById);

}else{
    
}
//if(!empty($_GET["id"])){
    //$route =  str_replace('views/produit.php','',$_SERVER['SCRIPT_FILENAME']);
    //require_once($route."models/ProduitsModel.php");
    //$productById = $produitModel->getProductsById($_GET["id"]);
//}


// verif sous categorie




// recuperation cataegorie et sous categorie