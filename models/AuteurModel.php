<?php
require_once('Model.php');

class AuteurModel extends Model
{
    public function __construct()
    {

    }

    public function insertAuteur($nom,$prenom)
    {
        $requete = $this->connect()->prepare("INSERT INTO auteurs(nom,prenom) VALUES(:nom, :prenom)");
        $resultat = $requete->execute(array(":nom" => $nom,
                                            ":prenom" => $prenom,
                                            ));

        return $resultat;
    }

    public function getAllAuteurs()
    {
        $requete = $this->connect()->prepare("SELECT * FROM auteurs");
        $requete->execute();
        $resultat = $requete->fetchAll(PDO :: FETCH_ASSOC);

        return $resultat;
    }

    public function getAuteursById($id)
    {
        $requete = $this->connect()->prepare("SELECT * FROM auteurs WHERE id = :id");
        $requete->execute(array(":id" => $id));
        $resultat = $requete->fetch(PDO :: FETCH_ASSOC);

        return $resultat;
    }
    public function deleteAuteur($id)
    {
        $requete = $this->connect()->prepare("DELETE FROM auteurs WHERE id=:id");
        $requete->execute(array(":id" => $id));
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);

        return $resultat;
    }

    public function updateAuteur($id,$nom,$prenom)
    { 
        $requete = $this->connect()->prepare("UPDATE auteurs SET nom= :nom, prenom = :prenom WHERE id = :id");
        $requete->execute(array(":id" => intval($id),
                                ":nom" => $nom,
                                ":prenom" => $prenom));
    }

}

?>