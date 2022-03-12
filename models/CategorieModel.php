<?php
require_once("Model.php");
class CategorieModel extends Model {
    public function __construct(){

    }
    public function getCategorie($id)
    {
        $requette = $this->connect()->prepare("SELECT * FROM `categories` WHERE `id`=:id");
        $requette->execute(array(":id" => $id));
        $resultat = $requette->fetchAll();
        
        var_dump($id);
        return $resultat;

    }
  
    public function allCategorie(){
        $requette = $this->connect()->prepare("SELECT * FROM `categories`");
        $requette->execute();
        $resultat = $requette->fetchAll();
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