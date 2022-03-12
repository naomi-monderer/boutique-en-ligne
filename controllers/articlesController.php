<?php
// Verif categorie
require_once("../models/ArticleModel.php"); 
require_once("../models/CategorieModel.php");

$categorie = new CategorieModel();
$articlesmodel = new ArticleModel();

// $titrecategorie = $categorie->getSousCategorie($_GET["id"]);


// Id == categorie
if(!empty($_GET["id"]))
{
    $titre = $categorie->getCategorie($_GET["id"]);
    var_dump($titre);
    //header
    // $categories = $categorie->allCategorie();

    $productByCategory =$articlesmodel->getProductsByCategory($_GET["id"]);
    if (empty($productByCategory)) {
        $erreur = "aucun article dans cette categorie";
    }
    
}else
{

}

// If id_souscategorie == articles des sous categories
if (!empty($_GET['id_souscategorie']))
{
    $titre = $categorie->getSousCategorie($_GET['id_souscategorie']);
    $productByCategory =$articlesmodel->getProductsBySousCategory($_GET['id_souscategorie']);
}



