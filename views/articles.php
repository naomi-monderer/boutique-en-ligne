<?php
// $route =  str_replace('views/articles.php','',$_SERVER['SCRIPT_FILENAME']);
// require($route.'controllers/articlesController.php');
require_once('../controllers/ArticlesController.php');
require_once('include/header.php');


?>
<main>
    
<nav>
    <a href="index.php">Retour a accueil</a>
   
   
    <?php


    foreach($categories as $resultat){
        echo " <a href='articles.php?id_souscategorie=".$resultat["id"]."'>".$resultat["nom_souscategorie"]."</a>";
    }
    

    ?>
   

    </nav>
     <section>

            <?php if (isset($titre['nom_categorie'])) :?>
                <h1><?php echo $titre['nom_categorie'] ?></h1>
            <?php else :?>
                <h1><?php echo $titre['nom_souscategorie'] ?></h1>
            <?php endif ;?>

            <?php if(isset($erreur)):?>
            <p><?php echo $erreur?></p>
            <?php else: ?>
            

        <?php foreach($productByCategory as $resultat) :?>
            <div>
                <div>
                    <a href="article.php?id=<?php echo $resultat['id_produit']?>"><img src="../picture/<?php echo $resultat["image"]; ?>" alt=""></a>
                    
                </div>
                <div>
                     <a href="article.php?id=<?php echo $resultat["id_produit"]?>"><p>Titre: <?php echo $resultat["titre"];  ?></p></a>
                     <p>Auteur: <?php  echo $resultat["nom"].' '. $resultat["prenom"];  ?></p>
                     <p>Description</p>
                     <p><?php echo $resultat["description"];?></p>
                </div>
                <div>
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

   