<?php
require_once("Model.php");

class ArticleModel extends Model{
    public function __construct()
    {

    }
    
    public function getProductsByCategory($id_categorie){
        $requette= $this->connect()->prepare("SELECT * FROM `produit` WHERE `id_categorie`= :id_categorie");
        $requette->execute(['id_categorie'=>$id_categorie]);
        $resultat = $requette->fetchall();
         return $resultat;
    }
    
    public function InsertArticle()
    {
        
    }

}
   
