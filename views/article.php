<?php

require_once("../controllers/ArticleController.php");
require_once('../controllers/CommentController.php');
$title = 'Article';
require_once('include/header.php');

// Vérififier si le formulaire à bien été envoyé 
if(isset($_POST['submit']))
{
    require_once("../models/CommentModel.php");
    $id_utilisateur = $_SESSION['user'][0]['id'];

    //Vérifier si l'utilisateur est connecté 
    if(isset($id_utilisateur))
    {

        $commentaires = trim(htmlspecialchars($_POST['comment']));

        $commentaireModel = new CommentModel();
        $commentaireModel->insertCommentaire($commentaires, $id_utilisateur, $_GET['id']);

        header("Refresh:0");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style//style.css">

    <title>Document</title>
</head>
<body>
 
    <main>
    
    
        <h1 class="titrearticle"><?php echo $produit["titre"];?></h1>
        <div class="article">
            
            <img class="imgarticle" src="<?php echo $produit['image'];?>" alt="">
            <div>
                <p><b> Auteur: </b></br></p>
                <p><em><?php echo  $produit["prenom"]; echo " ". $produit["nom"] ?></em></p>
                    <p><b>Description:<b></p>
                <p class="descriptionarticle"><em><?php  echo $produit["description"]  ?></em></p>
                <p><b>Prix:</b></p>
                <p><em><?php echo $produit['prix']?> €</em></p>

            </div>
            <div>
                <?php if($produit["stock"]>0):?>
                    <p class="enstock"> <i class="icon-ok-outline"></i>en stock</p>
                    <a class="buttonarticle" href="../controllers/PanierController.php?produit=<?= $_GET["id"] ?>">Ajouter au panier</a>
                <?php else: ?>
                    <p>Pas de stock</p>
                <?php endif;?>
            </div>
        </div>
        
    

<section>

    <h1>Commentaire</h1>
    
    <?php foreach($commentByIdProduit as $commentaire) : ?>

        <?php var_dump($commentaire['id_produit']); ?>

        <p>par <?= $commentaire['login'] ?> le <?=  date("d-m-Y à H:i", strtotime($commentaire['date'])) ?></p>
        <p><?= $commentaire['commentaire'] ?></p>

            <?php if((!empty($_SESSION)) && ($_SESSION['user'][0]['id'] == $commentaire['id_utilisateur'])) : ?>
            
                <form action="../views/article.php?id=<?= $_GET['id'] ?>" method="get">
                
                    <input type="submit" name="delete" value="supprimer">
                    <input type="hidden" name="idHidden" value="<?=$commentaire['id'];?>">
                    <input type="hidden" name="id" value="<?=$_GET['id'];?>">
                </form>

            <?php endif; ?>

        <?php endforeach; ?>

        <form action="" method="post">
            <div>
                <label for="textarea">Ecrivez votre commentaire :</label>
                <input type="textarea" name="comment" id="comment">
            </div>

            <input type="submit" name="submit" value="valider">
        </form>
    </section> 





</main>
<footer>
    <?php require_once('include/footer.php'); ?>
</footer>
    
</body>
</html>

















