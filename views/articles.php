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
            <?php  var_dump($resultat)    ?>
            <div>
                <p><?php echo $resultat["nom"];  ?></p>


            </div>
        <?php endforeach ;?>
    </section>

    </main>
    <footer>
        
    </footer>


    
</body>
</html>