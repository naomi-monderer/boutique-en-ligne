<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche</title>
</head>
<body>
    <header>
        <?php require('include/header.php'); ?>
    </header>

    <main>
        <!-- condition si session n'existe pas -->
        <?php
        
        if(!isset($_SESSION)) {

            header('location : index.php');
        }
        ?>

        <?php foreach($_SESSION['search'] as $resultat) : ?>

            <div class="articles">
                <div class="articleDiv">
                    <a href="article.php?id=<?php echo $resultat['id']?>"><img class="imgarticle" src="../picture/<?php echo $resultat["image"]; ?>" alt=""></a>
                    
                </div>
                <div class="articleDivDescription">
                     <a href="article.php?id=<?php echo $resultat["id"]?>"><p>Titre: <?php echo $resultat["titre"];  ?></p></a>
                     <p>Auteur: <?php  echo $resultat["nom"].' '. $resultat["prenom"];  ?></p>
                     <p>Description</p>
                     <p><?php echo $resultat["description"];?></p>
                </div>
                <div class="articleDiv">
                    <?php if($resultat["stock"]>0):?>
                        <p>En stock</p>
                        <a href="../controllers/PanierController.php?produit=<?= $resultat["id_produit"] ?>">Ajouter au panier</a>
                    <?php else:?>
                        <p>Temporairement en rupture de stock.</p>
                    <?php endif;?>
                </div>
                
            </div>

        <?php endforeach; ?>
    </main>

    <footer>

    </footer>
    
</body>
</html>

