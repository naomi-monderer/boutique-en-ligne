<?php
require_once("Model.php");
class SousCategorieModel extends Model
{

    public function getSousCategorieByName($nom_souscategorie)
    {
        $requette = $this->connect()->prepare("SELECT * FROM `souscategories` WHERE `nom_souscategorie`= :nom_souscategorie");
        $requette->execute(array(":nom_souscategorie" => $nom_souscategorie));
        $resultat = $requette->fetchAll(PDO :: FETCH_ASSOC);
        // var_dump($resultat);
        return $resultat;

    }

    public function getCategoriesByNameSousCategorie($id_categorie)
    {
        $requette = $this->connect()->prepare("SELECT nom_souscategorie FROM `souscategories` WHERE `id_categorie`= :id_categorie");
        $requette->execute(array(":id_categorie" => $id_categorie));
        $resultat = $requette->fetchAll(PDO :: FETCH_ASSOC);
        // var_dump($resultat);
        return $resultat;

    }

    public function allsouscategorie(){
        $requette = $this->connect()->prepare("SELECT * FROM `souscategories`");
        $requette->execute();
        while($resultat = $requette->fetchAll());
        {
            return $resultat;
        }
        
    }
    public function insertSousCategorie($nom_souscategorie,$id_categorie)
    {
        $requette = $this->connect()->prepare("INSERT INTO souscategories (nom_souscategorie, id_categorie) VALUES (:nom_souscategorie,:id_categorie)");
        $resultat = $requette->execute(array(":nom_souscategorie" => $nom_souscategorie,
                                  ":id_categorie" => $id_categorie
                                ));
        return $resultat; 
    }
}