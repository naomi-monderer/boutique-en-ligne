<?php



if(!empty($_GET["id"])){
    require_once("../models/CommentModel.php");
  
    $id = $_GET['id'];
    $commentModel = new CommentModel();
    $commentByIdProduit = $commentModel->getCommentaires($id);
}

if(!empty($_GET['delete']))
{
    if(isset($_GET['idHidden']))
    {

        require_once("../models/CommentModel.php");

        $id = $_GET['idHidden'];

        // j'apelle mon model
        $deleteComment = new CommentModel();
    
        // j'appelle ma methode delete dans le model
        $deleteComment->deleteCommentaire($id);

        header('location: produit.php');
    }


}