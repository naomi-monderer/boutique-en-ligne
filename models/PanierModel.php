<?php
require_once("Model.php");

class PanierModel extends Model{
    public function verificationarticle($id,$id_utilisateur){
        $requette = $this->connect()->prepare("SELECT * FROM `panier` WHERE `id_produit` =:id and `id_utilisateur`= :id_utilisateur");
        $requette->execute(["id"=>$id,"id_utilisateur"=>$id_utilisateur]);
        $resultat = $requette->fetchall();
        return $resultat;


    }
    public function ajoutaupanier($id_produit,$quantite,$id_utilisateur){
        $requette = $this->connect()->prepare("INSERT INTO `panier`( `id_produit`, `quantite`, `id_utilisateur`) VALUES (:id_produit,:quantite,:id_utilisateur)");
        $requette->execute(["id_produit"=>$id_produit,"quantite"=>$quantite,"id_utilisateur"=>$id_utilisateur]);
        
    }
    public function uptadepanier($quantite,$id_produit,$id_utilisateur){
        $requette = $this->connect()->prepare("UPDATE `panier` SET `quantite`=:quantite WHERE `id_produit`= :id_produit and `id_utilisateur`= :id_utilisateur");
        $requette->execute(["quantite"=>$quantite,"id_produit"=>$id_produit,"id_utilisateur"=>$id_utilisateur]);
        
    }

}