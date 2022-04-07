<?php
require_once('Model.php');

class CommentModel extends Model
{

    public function __construct()
    {

    }

    public function insertCommentaire($commentaire, $id_utilisateur, $id_produit)
    {
        $requete = $this->connect()->prepare('INSERT INTO commentaires(commentaire, id_utilisateur, id_produit, date) VALUES(:commentaire, :id_utilisateur, :id_produit, NOW())');
        $requete->execute(array(
            'commentaire' => $commentaire,
            'id_utilisateur' => $id_utilisateur,
            'id_produit' => $id_produit,
        ));
    }

    public function getCommentaires($id_produit)
    {
        $requete = $this->connect()->prepare('SELECT commentaires.id, commentaire, id_utilisateur, id_produit, date, utilisateurs.login
                                              FROM commentaires
                                              INNER JOIN produits ON produits.id = commentaires.id_produit
                                              INNER JOIN utilisateurs ON utilisateurs.id = commentaires.id_utilisateur
                                              WHERE produits.id = :id_produit');
        $requete->execute(array('id_produit' => $id_produit));
        $getCommentaires = $requete->fetchAll(PDO::FETCH_ASSOC);

        return $getCommentaires;
    }

    public function updateCommentaire()
    {
        $requete = $this->connect()->prepare('UPDATE `commentaires` SET `commentaire`= :commentaire WHERE id = :id');
        $updateCommentaire = $requete->execute(array('commentaire' => $commentaire, 'id' => $id));
    }

    public function deleteCommentaire($id)
    {
        $requete = $this->connect()->prepare(('DELETE FROM `commentaires` WHERE id = :id'));
        $requete->execute(['id' => $id]);
    }
}