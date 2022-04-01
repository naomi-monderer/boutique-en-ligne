<?php
session_start();
require_once("../models/ArticleModel.php");
require_once("../models/PanierModel.php");
$articles = new ArticleModel();
$panier = new PanierModel();

echo 'ok';

if(isset($_GET["produit"])){
  
    // verification du stock
    $stock = $articles->getstock($_GET["produit"]);
   
    if($stock["stock"]>=1){
        
        $id_utilisateur =intval($_SESSION["user"][0]["id"]);
        $id_produit = intval($_GET['produit']);
        $quantite = 1;
       
        $produitajouter = $panier->verificationarticle($id_produit,$id_utilisateur);
        var_dump($produitajouter);
        // je verifie si article a dega etai ajouter par utilisateur
        if(empty($produitajouter)){
            // on ajout le produit dans le panier 
            $panier->ajoutaupanier($id_produit,$quantite,$id_utilisateur);
            // mise a jour stock
            $miseajourstock = $stock["stock"]-1;
            $articles->uptadesotck($id_produit,$miseajourstock);
            header("location:../views/panier.php");

            
        }else{
            
            // on met a jour la quantiter 
            $quantite = $produitajouter[0]["quantite"]+1;
            $panier ->uptadepanier($quantite,$id_produit,$id_utilisateur);
            // mise a jour stock
            $miseajourstock = intval($stock["stock"])-1;
            var_dump($miseajourstock);
            $articles->uptadesotck($id_produit,$miseajourstock);
            header("location:../views/panier.php");


        }

        // probleme de stock qui ce met pas a jour





    }else{
       $_SESSION["erreur"]="le produit n'est pas en stock";
       header("location: ../views/articles.php?id=".$_GET['produit']);
    }
    
}
// on fait une recuperation pour afficher le panier
    $recuperation = $panier->recuperationpanier($_SESSION["user"][0]["id"]);
    // boucle quantite * prix 
    $total = 0;
    var_dump($total);
    foreach($recuperation as $resultat){

    
    $prix= $resultat["prix"]; 
    $quantiter= $resultat["quantite"]; 
    $prixquantite = $prix * $quantiter;
    $total = $prixquantite + $total;
    
    var_dump($total);     
        

    }
    // frai de port
    //  $total = $total + 5;
    



?>