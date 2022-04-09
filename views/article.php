<?php
require_once("../controllers/ArticleController.php");
$title='Article';
require_once('include/header.php');

?>
<main>
    <h1 class="titrearticle"><?php echo $produit["titre"];?></h1>
        <div class="article">
            
            <img class="imgarticle" src="../picture/<?php echo $produit['image'];  ?>" alt="">
            <div >
                <p>Auteur: <?php echo  $produit["prenom"]; echo " ". $produit["nom"] ?> </p>
                <p>Description</p>
                <p class="descriptionarticle"> <?php  echo $produit["description"]  ?></p>

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
            
                <form action="../views/produit.php?id=<?= $commentaire['id_produit'] ?>" method="get">
                
                    <input type="submit" name="delete" value="supprimer">
                    <input type="hidden" name="idHidden" value="<?=$commentaire['id'];?>">
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

















