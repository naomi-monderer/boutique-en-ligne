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
    public function innerCategoriesWithSousCategories(){

        $requette = $this->connect()->prepare(
        "SELECT *
        FROM `categories`
        INNER JOIN souscategories ON categories.id = souscategories.id_categorie 
        ORDER BY `categories`.`id` ASC ");
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
    public function deleteCategorie($id)
    {
        $requete = $this->connect()->prepare("DELETE FROM categories WHERE id=:id");
        $requete->execute(array(":id" => $id));
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);

        return $resultat;
    }
    
   public function updateCategorie($id,$nom_categorie)
   {
       $requete = $this->connect()->prepare("UPDATE categories SET nom_categorie = :nom_categorie WHERE id = :id");
       $requete->execute(array(":id" => $id,
                                ":nom_categorie" => $nom_categorie,
                                
                                        ));
    }

    

}




?>