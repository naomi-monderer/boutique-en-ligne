<?php
require_once("Model.php");

class Recherche extends Model
{
    function rechercheProduitsBySearch($search)
    {
        $requette= $this->connect()->prepare("SELECT * FROM produits WHERE titre LIKE '%".$search."%' ORDER BY id DESC");
        $requette->execute();
        $resultat = $requette->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

}