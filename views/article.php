<?php
require_once("../controllers/ArticleController.php");



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style//style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat&family=Dancing+Script&family=Roboto&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat&family=Dancing+Script&family=Roboto:ital,wght@1,100&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../style//fontello/css/fontello.css">
    <title>Document</title>
</head>
<body>
    <header>

    </header>
    <main>
    
    
        <h1 class="titrearticle"><?php echo $produit["titre"];?></h1>
        <div class="article">
            
            <img class="imgarticle" src="../picture/<?php echo $produit['image'];  ?>" alt="">
            <div >
                <p>Auteur: <?php echo  $produit["prenom"]; echo " ". $produit["nom"] ?> </p>
                <p>Description</p>
                <p><?php  echo $produit["description"]  ?></p>

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
        
    









</main>
<footer>

</footer>
    
</body>
</html>

















