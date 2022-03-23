<?php
require_once("Model.php");
class CategorieModel extends Model {
    public function __construct(){

    }
    public function getCategorie($nom_categorie)
    {
        $requette = $this->connect()->prepare("SELECT * FROM `categories` WHERE `nom_categorie`=:nom_categorie");
        $requette->execute(array(":nom_categorie" => $nom_categorie));
        $resultat = $requette->fetchAll(PDO :: FETCH_ASSOC);
        
        var_dump($nom_categorie);
        return $resultat;

    }
  
    public function allCategorie(){
        $requette = $this->connect()->prepare("SELECT * FROM `categories`");
        $requette->execute();
        $resultat = $requette->fetchAll(PDO :: FETCH_ASSOC);
        return $resultat;
        
    }

    public function insertCategorie($nom_categorie)
    {
        $requete = $this->connect()->prepare("INSERT INTO categories(nom_categorie) VALUES(:nom_categorie)");
        $resultat = $requete->execute(array(":nom_categorie" => $nom_categorie));

        return $resultat;
    }
    
        
    

}




?>