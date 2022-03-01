<?php
require('Model.php');

class CommentModel extends Model
{

    public function __construct()
    {

    }

    public function insertCommentaire($commentaire, $id_utilisateur, $id_produit)
    {
        $requete = $this->connect()->prepare('INSERT INTO commentaires(commentaire, id_utilisateur, id_article, date) VALUES(:commentaire, :id_utilisateur, :id_produit, NOW())');
        $requete->execute(array(
            'commentaire' => $commentaire,
            'id_utilisateur' => $id_utilisateur,
            'id_produit' => $id_produit,
        ));
    }

    public function getCommentaires()
    {
        $requete = $this->connect()->prepare('SELECT * FROM `commentaires`
                                 INNER JOIN produits ON produits.id = commentaires.id_produit
                                 WHERE produits.id = :produit_id');
        $requete->execute(array('produit_id' => $id_produit));
        $getCommentaires = $requete->fetchAll();

        return $commentaires;
    }

    public function updateCommentaire()
    {
        $requete = $this->connect()->prepare('UPDATE `commentaires` SET `commentaire`= :commentaire WHERE id = :id');
        $updateCommentaire = $requete->execute(array('commentaire' => $commentaire, 'id' => $id));
    }

    public function deleteCommentaire()
    {
        $requete = $this->connect()->prepare(('DELETE FROM `commentaires` WHERE id = :id'));
        $requete->execute(['id' => $id]);
    }
}