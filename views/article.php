<?php
require_once("../controllers/ArticleController.php");


?>
<main>
    
    
        <h1><?php echo $produit["titre"];?></h1>
        <div>
            
            <img src="../picture/<?php echo $produit['image'];  ?>" alt="">
            <div>
                <p>Auteur: <?php echo  $produit["prenom"]; echo " ". $produit["nom"] ?> </p>
                <p>Description</p>
                <p><?php  echo $produit["description"]  ?></p>

            </div>
            <div>
                <?php if($produit["stock"]>0):?>
                    <p>En stock</p>
                    <form action="../controllers/PanierController.php"method="POST">
                        <input type="hidden" name="produit" value="<?php echo $produit["id_produit"]  ?>">
                         <input type="submit"name="panier" value="panier">
                            
                        


                    </form>
                <?php else: ?>
                    <p>Pas de stock</p>
                <?php endif;?>


            </div>
        </div>
        
    









</main>















