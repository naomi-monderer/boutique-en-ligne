<?php
require_once("Model.php");
class SousCategorieModel extends Model
{

    public function getSousCategorie($id){
        $requette = $this->connect()->prepare("SELECT * FROM `souscategories` WHERE `id`=$id");
        $requette->execute();
        $resultat = $requette->fetch();
        return $resultat;

    }

    public function allsouscategorie(){
        $requette = $this->connect()->prepare("SELECT * FROM `souscategories`");
        $requette->execute();
        $resultat = $requette->fetchAll();
        return $resultat;
        
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