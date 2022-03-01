<?php
require('Model.php');

class commentModel extends Model
{

    public function __construct()
    {

    }

    public function insertCommentaire()
    {
        $requete = $this->connect()->prepare('INSERT INTO commentaires(commentaire, id_utilisateur, id_article, date) VALUES(:commentaire, :id_utilisateur, :id_article, NOW())');
        $requete->execute(array(
            'commentaire' => $commentaire,
            'id_utilisateur' => $_SESSION['id'],
            'id_produit' => $article_id,
        ));
    }

    public function getCommentaires()
    {
        $requete = $this->connect()->prepare('SELECT * FROM `commentaires`
                                 INNER JOIN produits ON produits.id = commentaires.id_produit
                                 WHERE produits.id = :produit_id');
        $requete->execute(array('produit_id' => $produit_id));
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