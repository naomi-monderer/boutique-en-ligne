<?php 
session_start(); 
var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payement</title>
</head>
<body>
    <header>

    </header>
    <main>
    <div class="container">
    <div class='row'>
        <div class='col-md-4 col-md-offset-4'>
            <h1>Page de payement</h1>
            <p>Montant à payer : <?= $_SESSION['total'] ?> €</p>
            <?php

            if(isset($_SESSION['erreur'])){
                echo '<p>'.$_SESSION['erreur']."</p>";
            }

            ?>
            <form action="../controllers/PayementController.php"  method="POST">
                
                <div >
                    <div'>
                        <label>Nom sur la carte</label>
                        <input type='text' name="name">
                    </div>
                </div>
                <div>
                    <div class='card'>
                        <label>Numéro de carte</label>
                        <input type='text' name="carte">
                    </div>
                </div>
               
                    <div>
                        <label>CVC</label>
                        <input placeholder='ex. 311' size='4' type='text' name="cvc">
                    </div>
                    <div >
                        <label>Expiration</label>
                        <input  placeholder='MM' size='2' type='text' name="expiration">
                    </div>
                    <div>
                        <label> </label>
                        <input placeholder='AA' size='4' type='text' name="expiration_year">
                    </div>
                </div>

                <button  type='submit'>Payer »</button>
                    
                </div>
            </form>
        </div>
    </div>
</div>

    </main>
    <footer>

    </footer>
    
</body>
</html>

<?php unset($_SESSION['erreur'] ) ;?>