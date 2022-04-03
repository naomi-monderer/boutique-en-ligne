<?php
// $route =  str_replace('views/articles.php','',$_SERVER['SCRIPT_FILENAME']);
// require($route.'controllers/articlesController.php');
require_once('../controllers/ArticlesController.php');
require_once('include/header.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Document</title>
</head>
<body>
    <header>

    </header>
    <main class="mainArticles"> 
    
        <nav>
            <a href="index.php">Retour a accueil</a>
            <p>Sous catégories :</p>
            <?php
            foreach($categories as $resultat){
            echo " <a class='aSousCat' href='articles.php?id_souscategorie=".$resultat["id"]."'>".$resultat["nom_souscategorie"]."</a>";
            }?>
        </nav>
        <section>

            <?php if (isset($titre['nom_categorie'])) :?>
                <h1 class="titreArtices"><?php echo $titre['nom_categorie'] ?></h1>
            <?php else :?>
                <h1 class="titreArtices"><?php echo $titre['nom_souscategorie'] ?></h1>
            <?php endif ;?>
            <hr>
            <?php if(isset($erreur)):?>
            <p><?php echo $erreur?></p>
            <?php else: ?>
            

        <?php foreach($productByCategory as $resultat) :?>
            <div class="articles">
                <div class="articleDiv">
                    <a href="article.php?id=<?php echo $resultat['id_produit']?>"><img class="imgarticle" src="../picture/<?php echo $resultat["image"]; ?>" alt=""></a>
                    
                </div>
                <div class="articleDivDescription">
                     <a href="article.php?id=<?php echo $resultat["id_produit"]?>"><p>Titre: <?php echo $resultat["titre"];  ?></p></a>
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
        <?php endforeach ;?>
        <?php endif;?>
    </section>
</main>
<footer>

</footer>

   
    
</body>
</html>
