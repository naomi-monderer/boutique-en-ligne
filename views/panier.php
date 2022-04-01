<?php
require_once("../controllers/PanierController.php");
var_dump($recuperation);
    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>panier</title>
</head>
<body>
    <header>

    </header>
    <main>
        <div>
            <section>
                <h1>panier</h1>
                <?php  foreach($recuperation as $resultat):?>
                    <!-- boucle image -->
                    <img src="../picture/<?php echo $resultat['image']?>" alt="">
                    <p>titre :<?= $resultat["titre"]?></p>
                    <p>quantité:<?= $resultat["quantite"]?> </p>

                    <?php endforeach; ?>




               
                    
                

                
            
                

            </section>
            <section>
                <h2>Recapitulatif</h2>
                <p>Total: <?php echo $total ?> €</p>
                <p>Frais de port: 5€</p>
                <p> Total de la commande: <?php echo $total + 5?>€</p>
                <a href="">Valider panier</a>

            </section>
        </div>
        <?php
        



?>
        

    </main>
    <footer>

    </footer>
    
</body>
</html>