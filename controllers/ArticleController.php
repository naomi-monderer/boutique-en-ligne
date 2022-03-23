<?php
require_once("../models/ArticleModel.php"); 


$articlesmodel = new ArticleModel();

if(!empty($_GET["id"])){
    $produit = $articlesmodel->getartiarticleid($_GET["id"]);
}

