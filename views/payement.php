<?php 



require('include/header.php');

?>

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
        

   

  
            <form class="row"  action="../controllers/PayementController.php"  method="POST">
            <fieldset>
    <legend>Adresse de livraison</legend>
      
          <label class="labelpayement" for=adresse>Adresse</label>
          <textarea id=adresse name="adresse" rows=5 required></textarea>
       
          <label class="labelpayement"   for=codepostal>Code postal</label>
          <input id=codepostal name="codepostal" type=text required>
        
          <label class="labelpayement"  for=pays>Pays</label>
          <input id=pays name="pays" type=text required>
        
            <label class="labelpayement"  for="ville">Votre ville</label>
            <input type="text" name="ville" id="">
       
  
    </fieldset>
                <div  >
                    <div>
                        <label class="labelpayement">Nom sur la carte</label>
                        <input type='text' name="name">
                    </div>
                </div>
                <div>
                    <div class='card'>
                        <label  class="labelpayement">Numéro de carte</label>
                        <input type='text' name="carte">
                    </div>
                </div>
               
                    <div>
                        <label class="labelpayement" >CVC</label>
                        <input placeholder='ex. 311' size='4' type='text' name="cvc">
                    </div>
                    <div class="divpayement">
                          <div >
                        <label  class="labelpayement">Mois</label>
                        <input id="inputepayement" placeholder='MM' size='2' type='text' name="expiration">
                    </div>
                    <div>
                        <label  class="labelpayement"> Année  </label>
                        <input id="inputepayement" placeholder='AA' size='4' type='text' name="expiration_year">
                    </div>
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
    <?php require_once('include/footer.php'); ?>
    </footer>


<?php unset($_SESSION['erreur'] ) ;?>