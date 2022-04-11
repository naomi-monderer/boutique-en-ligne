<?php
require_once('include/header.php');
require_once('../controllers/ConnexionController.php');
// require_once('../controllers/IndexController.php');

$controller = new ConnexionController();

?>

<main class = "page_accueil">

    <div class="sidebar">

        <a href="#">TOUS LES PRODUITS</a>
        <a href="#">TOUTES LES NOUVEAUTES</a>
        <a href="#">LES MEILLEURES VENTES</a>

        <!-- <form id="form1">
		    <label for="montrer">BD</label>
		    <input type="checkbox" name="montrer" id="montrer"/>

            <div class="contenu">

                <a href=""></a>
            </div>

        </form> -->

        <!-- <form id="form1">
            <label for="montrer">ROMAN</label>
            <input type="checkbox" name="montrer" id="montrer"/>

            <div class="contenu"> -->

            <?php foreach($afficherNomCategories as $afficher) : ?>

                <a href=""><?php echo $afficher['nom_categorie'] ?></a>

                <?php foreach($afficherNomSousCategories as $afficher) : ?>

                    <a class="sous" href=""><?php echo $afficher['nom_souscategorie'] ?></a>

                <?php endforeach; ?>
            <?php endforeach; ?>

            </div>
<!-- 
        </form> -->
    </div>

    <section>

        <article> 

        <?php foreach($afficherMiseEnAvant as $show) : ?>

            <img src="../picture/<?php echo $show['image'];  ?>" alt="">

        <?php endforeach; ?>

        </article>

        <h2>NOUVEAUTES</h2>

        
        <article> 

        <?php foreach($afficherNouveautes as $show) : ?>

            <img src="../picture/<?php echo $show['image'];  ?>" alt="">

        <?php endforeach; ?>

        
        </article> 

    </section>

</main>

<?php

require_once("include/footer.php");

?>
