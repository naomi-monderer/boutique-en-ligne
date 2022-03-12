<?php
require_once('Model.php');

class AuteurModel extends Model
{
    public function __construct()
    {

    }

    public function insertAuteur()
    {
        $requete = $this->connect()->prepare("INSERT INTO auteurs(nom,prenom) VALUES(:nom, :prenom)");
        $resultat = $requete->execute(array(":nom" => $nom,
                                            ":prenom" => $prenom,
                                            ));

        return $resultat;
    }

    // public function getAllAuteurs()
    // {

    // }

    // public function getAuteurById($id)
    // {

    // }


}

?>