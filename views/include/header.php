<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="../style/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Dancing+Script&family=Roboto&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Dancing+Script&family=Roboto:ital,wght@1,100&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style//fontello/css/fontello.css">
    
    <title><?=$title?></title>
</head>
<body>
    <header>

         <a href="index.php">  <img id="logo" src="../picture/logo_boutique.png">
</a> 
            
            <form action="../controllers/RechercheController.php" method="GET">
                <div class="search">
                    <input type="search" name="search" placeholder="Rechercher un livre...">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>

            <nav>

                <a href="index.php">Accueil</a>

                <?php if(!isset($_SESSION['user']))
                {?>
                 
                <a class="test" href="connexion.php">Connexion</a>
                <a href="inscription.php">Inscription</a>
             
                
                <?php }
                
                if(isset($_SESSION['user']))
                        {?>
                        <a href="profil.php"><i style="font-size:1.3em;" class="fa-solid fa-circle-user"></i></a></br>
                        <a href="panier.php"><i style="font-size:1.3em;" class="fa-solid fa-cart-shopping"></i></a></br>
                         <a href="deconnexion.php"><i style="font-size:1.3em;" class="fa-solid fa-right-from-bracket"></i></a></br>
                        
                          
                          

                <?php    }
                        //var_dump($_SESSION['user']);
                        if(isset($_SESSION['user']) && $_SESSION['user'][0]['id_droits'] == 1)
                        { ?>
                            <a href="admin.php"><i style="font-size:1.3em;" class="fa-solid fa-gears"></i></a></br>
                          
                        

                <?php   } ?>
   
            </nav>
    </header>
