<?php
// $route =  str_replace('views/articles.php','',$_SERVER['SCRIPT_FILENAME']);
// require($route.'controllers/articlesController.php');
require_once('../controllers/articlesController.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page article</title>
</head>
<body>
    <header>

    </header>
    <main>
        <section>
        <?php foreach($productByCategory as $resultat) :?>
           
            <div>
                <p><?php echo $resultat["nom"];  ?></p>
                <p><?php echo $resultat["description"];?></p>
                <p><?php echo $resultat["stock"];?></p>
                <p><?php echo $resultat["edition"];?></p>


            </div>
        <?php endforeach ;?>
    </section>

    </main>
    <footer>
        
    </footer>


    
</body>
</html>