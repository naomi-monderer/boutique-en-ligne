<?php 
session_start(); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style//style.css">
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
            <form class="formu" id=paiement>

   

  <fieldset>
    <legend>Adresse de livraison</legend>
      <ol>
        <li>
          <label for=adresse>Adresse</label>
          <textarea id=adresse name="adresse" rows=5 required></textarea>
        </li>
        <li>
          <label for=codepostal>Code postal</label>
          <input id=codepostal name="codepostal" type=text required>
        </li>
          <li>
          <label for=pays>Pays</label>
          <input id=pays name="pays" type=text required>
        </li>
        <li>
            <label for="ville">Votre ville</label>
            <input type="text" name="ville" id="">
        </li>
      </ol>
      </form>
    </fieldset>
            <form class="row"  action="../controllers/PayementController.php"  method="POST">
                
                <div class="formpayement" >
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

                <button class="payementbutton" type='submit'>Payer »</button>
                    
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