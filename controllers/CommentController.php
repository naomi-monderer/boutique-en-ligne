<?php

session_start();

require_once("../models/CommentModel.php");

//var_dump($_GET);


// Vérififier si le formulaire à bien été envoyé 
if(isset($_POST['commentaire']) && !empty($_POST['commentaire']))
{
        $id = 1;
        //Vérifier si l'utilisateur est connecté 
        if(isset($id))
            var_dump($id);
        {

            $commentaire = trim(htmlspecialchars($_POST['commentaire']));

            $commentaireModel = new CommentModel();
            $commentaireModel->insertCommentaire($commentaire, $id_utilisateur, $produit_id);
        }
}
