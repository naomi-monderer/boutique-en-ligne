<?php
// $route =  str_replace('views/articles.php','',$_SERVER['SCRIPT_FILENAME']);
// require($route.'controllers/articlesController.php');
require_once('../controllers/ArticlesController.php');
require_once('../controllers/IndexController.php');
require_once('include/header.php');


?>

    <main class="mainArticles"> 
    
        <nav>
            <a href="index.php">Retour a accueil</a>
            <p>Sous catégories :</p>
            <?php
            foreach($categories as $resultat){
            echo " <a class='aSousCat' href='articles.php?id_souscategorie=".$resultat["id"]."'>".$resultat["nom_souscategorie"]."</a>";
            }?>
        </nav>

        <!-- AFFICHAGE DE TOUS LES PRODUITS -->

        <section>

        <?php foreach($showAllProducts as $resultat) :?>

            <?php var_dump($resultat); ?>
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
                        <a class="buttonarticle" href="../controllers/PanierController.php?produit=<?= $resultat["id_produit"] ?>">Ajouter au panier</a>
                    <?php else:?>
                        <p>Temporairement en rupture de stock.</p>
                    <?php endif;?>  
                </div>
                
            </div>
        <?php endforeach ;?>

        </section>

        <!-- FIN AFFICHAGE TOUS LES PRODUITS -->


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
                        <a class="buttonarticle" href="../controllers/PanierController.php?produit=<?= $resultat["id_produit"] ?>">Ajouter au panier</a>
                    <?php else:?>
                        <p>Temporairement en rupture de stock.</p>
                    <?php endif;?>  
                </div>
                
            </div>
        <?php endforeach ;?>
        <?php endif;?>
    </section>
</main>
