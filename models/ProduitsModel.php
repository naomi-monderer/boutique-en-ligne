<?php
require_once("Model.php");

class ProduitsModel extends Model{
    public function __construct(){

    }
    public function getProductsById($id){
        $requette= $this->connect()->prepare("SELECT * FROM `produits` WHERE id = :id");
        $requette->execute(['id'=>$id]);
        $resultat = $requette->fetchall();
        
        return $resultat;
    }

}