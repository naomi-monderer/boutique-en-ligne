<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche</title>
</head>
<body>
    <header>
        <?php require('include/header.php'); ?>
    </header>

    <main>
        <!-- condition si session n'existe pas -->
        <?php
        
        if(!isset($_SESSION)) {

            header('location : index.php');
        }
        ?>

        <?php foreach($_SESSION['search'] as $resultat) : ?>

            <h3><?= $resultat['titre'] ?><h3>

        <?php endforeach; ?>
    </main>

    <footer>

    </footer>
    
</body>
</html>

