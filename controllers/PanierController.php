<?php
session_start();
require_once("../models/ArticleModel.php");
require_once("../models/PanierModel.php");
$articles = new ArticleModel();



if(isset($_POST["panier"])){
    var_dump($_POST);
    // verification du stock
    $stock = $articles->getstock($_POST["produit"]);
    var_dump($stock);
    if($stock["stock"]>=1){
        var_dump($_SESSION);
        $id_utilisateur =intval($_SESSION["user"][0]["id"]);
        $id_produit = intval($_POST['produit']);
        $quantite = 1;
        $panier = new PanierModel();
        $produitajouter = $panier->verificationarticle($id_produit,$id_utilisateur);
        var_dump($produitajouter);
        // je verifie si article a dega etai ajouter par utilisateur
        if(empty($produitajouter)){
            // on ajout le produit dans le panier 
            $panier->ajoutaupanier($id_produit,$quantite,$id_utilisateur);
            // mise a jour stock
            $miseajourstock = $stock["stock"]-1;
            $articles->uptadesotck($id_produit,$miseajourstock);

            
        }else{
            // on met a jour la quantiter 
            $quantite = $produitajouter[0]["quantite"]+1;
            $panier ->uptadepanier($quantite,$id_produit,$id_utilisateur);
            // mise a jour stock
            $miseajourstock = $stock["stock"]-1;
            $articles->uptadesotck($id_produit,$miseajourstock);


        }

        // probleme de stock qui ce met pas a jour





    }else{
       $_SESSION["erreur"]="le produit n'est pas en stock";
    }
    
}



?>