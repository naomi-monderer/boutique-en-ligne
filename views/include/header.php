<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
            <nav>

                <a href="connexion.php">CONNEXION</a> </br>
                <a href="inscription.php">INSCRIPTION</a></br>
                <a href="index.php">ACCUEIL</a></br>
                
                <?php if(isset($_SESSION['user']))
                        {?>
                          <a href="profil.php">PROFIL</a></br>
                          <a href="index.php">ACCUEIL</a></br>
                          

                <?php    }

                        if(isset($_SESSION['user']) && $_SEESION['user'][0]['id_droits'] == 1)
                        { ?>
                            <a href="admin.php">Espace Administrateur</a>
                            <a href="index.php">Accueil</a>
                        

                <?php   } ?>

              
                
            </nav>
    </header>
