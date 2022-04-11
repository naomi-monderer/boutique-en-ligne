<?php
require_once("../controllers/PanierController.php");


    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style//fontello/css/fontello.css">
    <title>panier</title>
</head>
<body class="bodypanier">
    <header>

    </header>
    <main class="panier">
        <div class='firstDiv'>
        <h2>Panier</h2>
        <section >
        <?php if(!empty($recuperation)):  ?>

           

      
                
                <?php  foreach($recuperation as $resultat):?>
                    <div class="sectionpanier">
                    <!-- boucle image -->
                    <img class="imgarticlePanier" src="../picture/<?php echo $resultat['image']?>" alt="">
                    <div class="descriptionpanier">
                        <div class="divdescarticle">
                            <p>Titre : <?= $resultat["titre"]?></p>
                            <p>Auteur: <?=$resultat["nom"] .' '.$resultat["prenom"]?></p>
                            <p>Quantité: <?= $resultat["quantite"]?> </p>
                            <?php if($resultat["stock"]>0):?>
                            <p class="enstock"> <i class="icon-ok-outline"></i>  En stock</p>
                            <?php  endif;?>

                        </div>
                        <div class="prixArticle">
                            <p><?= $resultat["prix"]?> €</p>
                            
                            <a href="../controllers/PanierController.php?delete=<?php echo $resultat['id']; ?>">Supprimer</a>

                        </div>
                    </div>
                    
                    
                    </div>
                    <?php endforeach; ?>
                    
        <?php else:    ?>
            <p class="ppanier">Votre panier est vide</p>
            <?php endif;?>
        
                    




               
                    
                

                
            
                

            </section>

        </div>
   
        
            
            <div class="divrecap">
            <h2>Recapitulatif</h2>
            <section>
                
                
                <p>Total: <?php echo $total ?> €</p>
                <?php if(!empty($recuperation)):?>
                <p>Frais de port: 5€</p>
                <p> Total de la commande: <?php echo $total + 5?>€</p>
                <a class="buttonarticle" href="payement.php">Valider le panier</a>
                <?php endif;?>
            </section>

            </div>
           
        
        <?php
        



?>
        

    </main>
    <footer>

    </footer>
    
</body>
</html>