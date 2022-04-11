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
    public function recuperationpanier($id){
        $requette = $this->connect()->prepare("SELECT * FROM `panier` INNER JOIN produits ON panier.id_produit = produits.id INNER JOIN auteurs on auteurs.id = produits.id_auteur WHERE `id_utilisateur`=:id");
        $requette->execute(["id"=>$id]);
        $resultat = $requette->fetchAll();
        return $resultat;
        

    }

    public function delete($id){
        $requette = $this->connect()->prepare("DELETE FROM `panier` WHERE `id_utilisateur` = :id");
        $requette->execute(["id"=>$id]);
       
    }
    public function deleterarticlepanier($id){
        $requette = $this->connect()->prepare("DELETE FROM `panier` WHERE `id_produit`= :id");
        $requette->execute(["id"=>$id]);
    }
  

}