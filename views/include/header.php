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
    <link rel="stylesheet" href="../style//fontello/css/fontello.css">
    <title><?=$title?></title>
</head>
<body>
    <header>

            <img id="logo" src="../picture/logo_boutique.png">

            
            <form action="../controllers/RechercheController.php" method="GET">
                <div class="search">
                    <input type="search" name="search" placeholder="Rechercher un livre...">
                    <button type="submit">OK</button>
                </div>
            </form>

            <nav>

                <?php if(!isset($_SESSION['user']))
                {?>
                 
                <a class="test" href="connexion.php">Connexion</a>
                <a href="inscription.php">Inscription</a>
             
                
        <?php }
                
                if(isset($_SESSION['user']))
                        {?>
                        <a href="profil.php">Profil</a></br>
                         <a href="deconnexion.php">déconnexion</a></br>
                         <a href="panier.php">Panier</a>
                          
                          

                <?php    }
                        //var_dump($_SESSION['user']);
                        if(isset($_SESSION['user']) && $_SESSION['user'][0]['id_droits'] == 1)
                        { ?>
                            <a href="admin.php">Espace Administrateur</a></br>
                          
                        

                <?php   } ?>
   
            </nav>
    </header>
