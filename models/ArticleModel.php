<?php
require_once("Model.php");

class ArticleModel extends Model{
    public function __construct()
    {

    }
    
    public function getProductsByCategory($id_categorie){
        $requette= $this->connect()->prepare("SELECT * , produits.id AS id_produit FROM `produits` INNER JOIN auteurs ON id_auteur = auteurs.id WHERE `id_categorie`= :id_categorie");
        $requette->execute(['id_categorie'=>$id_categorie]);
        $resultat = $requette->fetchall();
         return $resultat;
    }
    public function getProductsBySousCategory($id_souscategorie){
        $requette= $this->connect()->prepare("SELECT *, produits.id AS id_produit FROM `produits` INNER JOIN auteurs ON id_auteur = auteurs.id WHERE `id_souscategorie`= :id_souscategorie");
        $requette->execute(['id_souscategorie'=>$id_souscategorie]);
        $resultat = $requette->fetchall();
         return $resultat;
    }

    public function getsouscategorie($id){
        $requette= $this->connect()->prepare("SELECT * FROM `souscategories`where id_categorie =:id ");
        $requette->execute(["id"=>$id]);
        $resultat= $requette->fetchAll();
        return  $resultat;
    }

    

    public function getartiarticleid($id)
    {
        $requette = $this->connect()->prepare("SELECT *, produits.id AS id_produit FROM `produits` INNER JOIN auteurs ON id_auteur = auteurs.id WHERE produits.id=:id");
        $requette->execute(["id"=>$id]);
        $resultat = $requette->fetch();
        return $resultat;
    }
   
   
   public function getstock($id){
        $requette= $this->connect()->prepare("SELECT `stock` FROM produits WHERE `id`=:id");
        $requette->execute(["id"=>$id]);
        $resultat = $requette->fetch();
        return $resultat;
    }

    public  function uptadesotck($id_produit,$quantite)
    {
          $requette = $this->connect()->prepare("UPDATE `produits` SET `stock`=:quantite WHERE `id`=:id_produit");
          $requette->execute(["quantite"=>$quantite,"id_produit"=>$id_produit]);
          
    }
    public function insertArticle($titre,$description,$stock,$prix,$mise_en_avant,$editeur,$id_categorie,$id_souscategorie,$id_auteur,$image)
    {
        $sql= "INSERT INTO produits (titre,description,stock,prix,mise_en_avant,editeur,id_categorie,id_souscategorie,id_auteur,image)
                   VALUES (:titre,:description,:stock,:prix,:mise_en_avant,:editeur,:id_categorie,:id_souscategorie,:id_auteur,:image)";
        $requete = $this->connect()->prepare($sql);
        $requete->execute(array(
                            ":titre" => $titre,
                            ":description" => $description,
                            ":stock" => intval($stock),
                            ":prix" => $prix,
                            ":mise_en_avant" => $mise_en_avant,
                            ":editeur" => $editeur,
                            ":id_categorie" => $id_categorie,
                            ":id_souscategorie" => $id_souscategorie,
                            ":id_auteur" => $id_auteur,
                            ":image" => $image
                           )); 
                           var_dump($mise_en_avant);        
    //     if($requete)
    //     var_dump($requete , ':))))');
    //     else
    //     {
    //         var_dump($requete , ':(((((');
    //         $_SESSION['error'] = 'oupssss';

    //     }
    }
    
    public function getAllArticles(){
        $requete = $this->connect()->prepare("SELECT * From produits");
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat;
    }
    public function getArticle($id){
        $requete = $this->connect()->prepare("SELECT * From produits WHERE id = :id");
        $requete->execute(array(":id" => $id));
        $resultat = $requete->fetch(PDO :: FETCH_ASSOC);

        return $resultat;
    }
    
    public function InnerArticlesWithOptions()
    {
        $sql = "SELECT produits.*, categories.nom_categorie, souscategories.nom_souscategorie, auteurs.nom , auteurs.prenom
                FROM produits
                INNER JOIN categories ON produits.id_categorie = categories.id
                INNER JOIN souscategories ON produits.id_souscategorie = souscategories.id
                INNER JOIN auteurs ON produits.id_auteur = auteurs.id
                ";
        $requete = $this->connect()->prepare($sql);
        $requete->execute();
        $resultat = $requete->fetchAll(PDO :: FETCH_ASSOC);       
        
        return $resultat;
    }

    public function deleteArticle($id)
    {   

        $sql = "DELETE FROM produits WHERE id = :id";
        $requete = $this->connect()->prepare($sql);
        $requete->execute(array('id' => intval($id)));
    }

    public function updateArticle($id,$titre,$description,$stock,$prix,$mise_en_avant,$editeur,$id_categorie,$id_souscategorie,$id_auteur,$image)
    {
        $sql = "UPDATE `produits` SET `titre`=:titre,`description`= :description ,`stock`=:stock, `prix`=:prix,`mise_en_avant`=:mise_en_avant, `editeur`=:editeur,`id_categorie`=:id_categorie,`id_souscategorie`=:id_souscategorie,`id_auteur`=:id_auteur ,`image`=:image WHERE `id` = :id";
        $requete = $this->connect()->prepare($sql);
        $requete->execute(array(":id" => $id,
                                ":titre"=>$titre,
                                ":description"=>$description,
                                ":stock"=>$stock,
                                ":prix" => $prix,
                                ":mise_en_avant"=>$mise_en_avant,
                                ":editeur"=>$editeur,
                                ":id_categorie"=>$id_categorie,
                                ":id_souscategorie"=>$id_souscategorie,
                                ":id_auteur"=>$id_auteur,
                                ":image"=>$image
                            ));

    }

    public function getProductsByMiseEnAvant() {
        $requete = $this->connect()->prepare("SELECT * , produits.id as id_produit FROM `produits` INNER JOIN auteurs ON id_auteur = auteurs.id WHERE mise_en_avant = 1 ORDER BY id_produit DESC LIMIT 5");
        $requete->execute();
        $resultat = $requete->fetchAll();
        return $resultat;
    }

    public function getProductsByNouveautes() {
        $requete = $this->connect()->prepare("SELECT * , produits.id AS id_produit FROM `produits` INNER JOIN auteurs ON id_auteur = auteurs.id ORDER BY id_produit DESC LIMIT 5");
        $requete->execute();
        $resultat = $requete->fetchAll();
        return $resultat;
    }

    public function getAllProducts() {
        $requete = $this->connect()->prepare("SELECT * FROM `produits` ORDER BY id DESC");
        $requete->execute();
        $resultat = $requete->fetchAll();
        return $resultat;
    }
}
   
