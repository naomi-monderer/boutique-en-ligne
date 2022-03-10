<?php
require_once("Model.php");

class ArticleModel extends Model{
    public function __construct(){

    }
    public function getProductsByCategory($id_categorie){
        $requette= $this->connect()->prepare("SELECT * FROM `produits` INNER JOIN auteurs ON id_auteur = auteurs.id WHERE `id_categorie`= :id_categorie");
        $requette->execute(['id_categorie'=>$id_categorie]);
        $resultat = $requette->fetchall();
         return $resultat;
    }
    public function getProductsBySousCategory($id_souscategorie){
        $requette= $this->connect()->prepare("SELECT * FROM `produits` INNER JOIN auteurs ON id_auteur = auteurs.id WHERE `id_souscategorie`= :id_souscategorie");
        $requette->execute(['id_souscategorie'=>$id_souscategorie]);
        $resultat = $requette->fetchall();
         return $resultat;
    }
    public function getsouscategorie($id_souscategorie){
        $requette= $this->connect()->prepare("SELECT * FROM `souscategories` ");
        $requette->execute(["non_souscategorie=>$id_souscategorie"]);
        $resultat= $requette->fetchAll();
        return  $resultat;
    }
       public function getarticleif($id){
           $requette = $this->connect()->prepare("SELECT * FROM `produits` INNER JOIN auteurs ON id_auteur = auteurs.id WHERE produits.id=:id");
           $requette->execute(["id"=>$id]);
           $resultat = $requette->fetch();
           return $resultat;
       }

}
   
