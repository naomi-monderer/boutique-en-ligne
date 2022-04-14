<?php
require_once('include/header.php');
require_once('../controllers/ConnexionController.php');
require_once('../controllers/IndexController.php');

$controller = new ConnexionController();

?>

<main class = "page_accueil">

    <div class="sidebar">

    <p>LES CATEGORIES :</p>
        <?php foreach($afficherNomCategories as $show) : ?>
 
            <a href="articles.php?id=<?php echo $show['id'] ?>"><?php echo $show['nom_categorie'] ?></a>
        <?php endforeach; ?>

    </div>

    <section>

        <h2>LES BONS PLANS</h2>

        <article>

        <?php foreach($afficherMiseEnAvant as $show) : ?>

            <a href="article.php?id=<?php echo $show['id_produit']; ?>">
                    
                <img src="<?php echo $show['image'];  ?>" alt="">
                <p>Titre : <?php echo $show['titre']; ?></p>
                <p>Auteur : <?php echo $show['nom'] . " " . $show['prenom']; ?></p>
                <p>Prix : <?php echo $show['prix'] . " "; ?>€</p>
            </a>

        <?php endforeach; ?>

        </article>

        <h2>LES NOUVEAUTES</h2>

        
        <article>

        <?php foreach($afficherNouveautes as $show) : ?>


            <a href="article.php?id=<?php echo $show['id_produit']; ?>">
                    
                <img src="<?php echo $show['image'];  ?>" alt="">
                <p>Titre : <?php echo $show['titre']; ?></p>
                <p>Auteur : <?php echo $show['nom'] . " " . $show['prenom']; ?></p>
                <p>Prix : <?php echo $show['prix'] . " "; ?>€</p>
            </a>
        
        <?php endforeach; ?>

        </article> 

    </section>

</main>

<?php

require_once("include/footer.php");

?>
