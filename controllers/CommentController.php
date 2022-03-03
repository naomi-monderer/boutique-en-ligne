<?php

session_start();

if(!empty($_GET["id"])){
    require_once("../models/CommentModel.php");
  
    $id = $_GET['id'];
    $commentModel = new CommentModel();
    $commentByIdProduit = $commentModel->getCommentaires($id);
}

if(!empty($_GET['delete'])) {

    require_once("../models/CommentModel.php");

    // je recupère l'id du get
    $id_delete = $_GET['delete'];

    // j'apelle mon model
    $deleteComment = new CommentModel();

    // j'appelle ma methode delete dans le model
    $commentByIdProduit = $deleteComment->deleteCommentaire($id_delete);

    //redirection vers la page du produit
    header("location: ../views/produit.php?id=" . $_GET['produit']);

}