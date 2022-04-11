<?php
require_once('../controllers/ConnexionController.php');
require_once('include/header.php');
$controller = new ConnexionController();

?>

<main class = "page_accueil">

    <div class="sidebar">

        <a href="#">TOUS LES PRODUITS</a>
        <a href="#">TOUTES LES NOUVEAUTES</a>
        <a href="#">LES MEILLEURES VENTES</a>

    </div>

    <section>

        <h2>LES BONS PLANS</h2>

        <article>

            <img src="../picture/asterix.jpg">
            <img src="../picture/La-Permaculture-au-jardin-mois-par-mois.jpg">
            <img src="../picture/Boule-Bill-Bill-se-tient-a-Caro.jpg">
            <img src="../picture/Bug.jpg">
            <img src="../picture/Bug.jpg">
        </article>

        <h2>NOUVEAUTES</h2>

        <article>
            
            <img src="../picture/asterix.jpg">
            <img src="../picture/La-Permaculture-au-jardin-mois-par-mois.jpg">
            <img src="../picture/Boule-Bill-Bill-se-tient-a-Caro.jpg">
            <img src="../picture/Bug.jpg">
            <img src="../picture/Bug.jpg">
        </article>

        <h2>LES MEILLEURES VENTES</h2>

        <article>

            <img src="../picture/asterix.jpg">
            <img src="../picture/asterix.jpg">
            <img src="../picture/asterix.jpg">
            <img src="../picture/asterix.jpg">
            <img src="../picture/Bug.jpg">
        </article>

    </section>

</main>

<?php

require_once("include/footer.php");

?>
