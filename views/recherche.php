
<?php 
require('include/header.php');

?>

<main class="page_recherche">

    <?php
    
    if(!isset($_SESSION)) {

        header('location : index.php');
    }
    ?>

    <h1 class="titrearticle">RECHERCHE</h1>
    <hr>

    <?php foreach($_SESSION['search'] as $resultat) : ?>

        <div class="articles">
            <div class="articleDiv">
                <a href="article.php?id=<?php echo $resultat['id_produit']?>"><img class="imgarticle" src="<?php echo $resultat["image"]; ?>" alt=""></a>
                
            </div>
            <div class="articleDescription">
                    <a href="article.php?id=<?php echo $resultat["id_produit"]?>"><p>Titre: <?php echo $resultat["titre"];  ?></p></a>
                    <p>Auteur: <?php  echo $resultat["nom"].' '. $resultat["prenom"];  ?></p>
                    <p>Description</p>
                    <p><?php echo $resultat["description"];?></p>
            </div>
            <div class="articleButton">
                <?php if($resultat["stock"]>0):?>
                    <p>En stock</p>
                    <a class="buttonarticle" href="../controllers/PanierController.php?produit=<?= $resultat["id_produit"] ?>">Ajouter au panier</a>
                <?php else:?>
                    <p>Temporairement en rupture de stock.</p>
                <?php endif;?>  
            </div>
            
        </div>

    <?php endforeach; ?>
</main>

<?php
require('include/footer.php');
?>
