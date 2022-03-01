<?php

session_start();

require_once("../models/CommentModel.php");

var_dump($_GET);

// On détermine sur quelle page on se trouve
if(isset($_GET['id']) && !empty($_GET['id'])) {

    $pageCourante = (int)strip_tags($_GET['id']);

}else{

    $pageCourante = 1;
}

// Vérififier si le formulaire à bien été envoyé 
if(isset($_POST['commentaire']) && !empty($_POST['commentaire']))
{
        $id_utilisateur = 1;
        //Vérifier si l'utilisateur est connecté 
        if(isset($id_utilisateur))
        {

            $commentaire = trim(htmlspecialchars($_POST['commentaire']));

            $commentaireModel = new CommentModel();
            $commentaireModel->insertCommentaire($commentaire, $id_utilisateur, $id_produit);
        }
}
