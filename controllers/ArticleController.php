<?php
require_once("../models/ArticleModel.php"); 


$articlesmodel = new ArticleModel();

if(!empty($_GET["id"])){
    $produit = $articlesmodel->getarticleif($_GET["id"]);
    var_dump($produit)
    

  

    


}

