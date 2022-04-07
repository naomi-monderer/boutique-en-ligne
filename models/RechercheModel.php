<?php
require_once("Model.php");

class Recherche extends Model
{
    function rechercheProduitsBySearch($search)
    {
        $requette= $this->connect()->prepare("SELECT * , produits.id AS id_produit FROM `produits` INNER JOIN auteurs ON id_auteur = auteurs.id WHERE titre LIKE '%".$search."%' ORDER BY id_produit DESC");
        $requette->execute();
        $resultat = $requette->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

}