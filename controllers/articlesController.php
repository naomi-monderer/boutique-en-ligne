<?php
// Verif categorie
require_once("../models/ArticleModel.php"); 
require_once("../models/CategorieModel.php");

$categorie = new CategorieModel();
$articlesmodel = new ArticleModel();

// $titrecategorie = $categorie->getsouscategorie($_GET["id"]);


// Id == categorie
if(!empty($_GET["id"])){
    $titre = $categorie->recuperationNoncategorie($_GET["id"]);
    var_dump($titre);
    //header
    // $categories = $categorie->allcategorie();

    $productByCategory =$articlesmodel->getProductsByCategory($_GET["id"]);
    if (empty($productByCategory)) {
        $erreur = "aucun article dans cette categorie";
    }
    
  


}else
{

}

// If id_souscategorie == articles des sous categories
if (!empty($_GET['id_souscategorie'])){
    $titre = $categorie->recuperationNonSouscategorie($_GET['id_souscategorie']);
    $productByCategory =$articlesmodel->getProductsBySousCategory($_GET['id_souscategorie']);
}









// verif sous categorie




// recuperation cataegorie et sous categorie