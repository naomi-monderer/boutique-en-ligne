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
    <title>Document</title>
</head>
<body>
    <header>

            <img id="logo" src="../picture/logo_boutique.png">

            <form action="../controllers/RechercheController.php" method="GET">

                <input type="search" name="search" placeholder="Rechercher un livre..." >
                <button type="submit">Rechercher</button>
            </form>

            <nav>

                <?php if(!isset($_SESSION['user']))
                {?>
                 
                <a href="connexion.php">Connexion</a>
                <a href="inscription.php">Inscription</a>
                <a href="panier.php">Panier</a>
             
                
        <?php }
                
                if(isset($_SESSION['user']))
                        {?>
                        <a href="profil.php">Profil</a></br>
                         <a href="deconnexion.php">déconnexion</a></br>
                          
                          

                <?php    }
                        //var_dump($_SESSION['user']);
                        if(isset($_SESSION['user']) && $_SESSION['user'][0]['id_droits'] == 1)
                        { ?>
                            <a href="admin.php">Espace Administrateur</a></br>
                          
                        

                <?php   } ?>
   
            </nav>
    </header>
