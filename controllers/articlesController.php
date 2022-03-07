<?php
// Verif categorie
require_once("../models/ArticleModel.php"); 
require_once("../models/CategorieModel.php");
$categorie = new CategorieModel();
$titre = $categorie->recuperationNoncategorie($_GET["id"]);

$articlesmodel = new ArticleModel();

if(!empty($_GET["id"])){

    $categories = $categorie->allcategorie();
    $productByCategory =$articlesmodel->getProductsByCategory($_GET["id"]);
    if (empty($productByCategory)) {
    $erreur = "aucun article dans cette categorie";

    }
    
  


}else{

}

// If





// verif sous categorie




// recuperation cataegorie et sous categorie