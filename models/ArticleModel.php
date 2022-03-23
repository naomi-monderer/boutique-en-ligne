<?php
require_once("Model.php");

class ArticleModel extends Model{
    public function __construct()
    {

    }
    
    public function getProductsByCategory($id_categorie){
        $requette= $this->connect()->prepare("SELECT * , produits.id AS id_produit FROM `produits` INNER JOIN auteurs ON id_auteur = auteurs.id WHERE `id_categorie`= :id_categorie");
        $requette->execute(['id_categorie'=>$id_categorie]);
        $resultat = $requette->fetchall();
         return $resultat;
    }
    public function getProductsBySousCategory($id_souscategorie){
        $requette= $this->connect()->prepare("SELECT *, produits.id AS id_produit FROM `produits` INNER JOIN auteurs ON id_auteur = auteurs.id WHERE `id_souscategorie`= :id_souscategorie");
        $requette->execute(['id_souscategorie'=>$id_souscategorie]);
        $resultat = $requette->fetchall();
         return $resultat;
    }
    public function getsouscategorie(){
        $requette= $this->connect()->prepare("SELECT * FROM `souscategories` ");
        $requette->execute();
        $resultat= $requette->fetchAll();
        return  $resultat;
    }
       public function getartiarticleid($id){
           $requette = $this->connect()->prepare("SELECT *, produits.id AS id_produit FROM `produits` INNER JOIN auteurs ON id_auteur = auteurs.id WHERE produits.id=:id");
           $requette->execute(["id"=>$id]);
           $resultat = $requette->fetch();
           return $resultat;
       }

    public function insertArticle()
    {
        
    }
    public function getstock($id){
        $requette= $this->connect()->prepare("SELECT `stock` FROM produits WHERE `id`=:id");
        $requette->execute(["id"=>$id]);
        $resultat = $requette->fetch();
        return $resultat;
    }
    public  function uptadesotck($id_produit,$quantite){
          $requette = $this->connect()->prepare("UPDATE `produits` SET `stock`=:quantite WHERE `id`:id_produit");
          $requette->execute(["quantite"=>$quantite,"id_produit"=>$id_produit]);
          

    }

}
   
