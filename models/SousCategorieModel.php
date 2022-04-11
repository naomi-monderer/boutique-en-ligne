<?php

require_once("Model.php");
class SousCatgeorieModel extends Model
{

    public function recuperationNomSousCategorie($id){
        $requette = $this->connect()->prepare("SELECT * FROM `souscategories` WHERE `id`=$id");
        $requette->execute();
        $resultat = $requette->fetch();
        return $resultat;
    }

    public function allsouscategorie(){
        $requette = $this->connect()->prepare("SELECT * FROM `souscategories`");
        $requette->execute();
        $resultat = $requette->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
        
    }
}