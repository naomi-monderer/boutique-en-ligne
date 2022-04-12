<?php

require_once("../models/ArticleModel.php");
require_once("../models/SousCategorieModel.php");
require_once("../models/CategorieModel.php");

$nomCategorie = new CategorieModel;
$afficherNomCategories = $nomCategorie->allcategorie();

$nomSousCategorie = new SousCategorieModel;
$afficherNomSousCategories = $nomSousCategorie->allsouscategorie();

$miseEnAvant = new ArticleModel;
$afficherMiseEnAvant = $miseEnAvant->getProductsByMiseEnAvant();

$nouveautes = new ArticleModel;
$afficherNouveautes = $nouveautes->getProductsByNouveautes();

$allProducts = new ArticleModel;
$showAllProducts = $allProducts->getAllProducts();