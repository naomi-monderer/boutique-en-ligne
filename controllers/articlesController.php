<?php
var_dump($_GET);
// Verif categorie
if(!empty($_GET["id"])){
    require_once("../models/ArticleModel.php"); 

  
    $articlesmodel = new ArticleModel();
    $productByCategory =$articlesmodel->getProductsByCategory($_GET["id"]);


}else{
    
}
// if(!empty($_GET["id"])){
//     $route =  str_replace('views/articles.php','',$_SERVER['SCRIPT_FILENAME']);
//     require_once($route."models/Article.php");
//     $productByCategory = $articlesmodel->getProductsByCategory($_GET["id"]);
// }


// verif sous categorie




// recuperation cataegorie et sous categorie