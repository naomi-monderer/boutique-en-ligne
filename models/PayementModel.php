<?php
require_once("../models/Model.php");
class payementModel extends Model{

    public function createCommande($commande,$total,$id){
        $requete = $this->connect()->prepare("INSERT INTO `commandes`( `date`, `total`, `id_utilisateur`, `id_commande`) VALUES (NOW(), :total, :id, :commande)");
        var_dump($requete);
        $requete->execute(["commande" => $commande, "total" => $total , "id" => $id]);

    }

    public function createDetailCommande($id_produit,$quantite,$id_commande){
        $requete = $this->connect()->prepare("INSERT INTO `detail_commande`( `id_produit`, `quantite`, `id_commande`) VALUES ($id_produit,$quantite ,$id_commande)");
        var_dump($requete);
        $requete->execute();
    }
}




?>