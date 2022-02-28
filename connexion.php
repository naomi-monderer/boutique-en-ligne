<?php
  require_once('include/header.php');
?>
    <?php  if(isset($_SESSION["erreur"])) :?>
    <?php echo $_SESSION["erreur"];?>
    <?php endif;?>
    
    <main>
        <form action="traitement/traitement-connexion.php" method="POST">
            <div>
                <label for="login">Votre login</label>
                <input type="text" name="login" id="login">
            </div>
            <div>
                <label for="password">Votre password</label>
                <input type="password" name="password" id="password">
            </div>

            <button class="buttonform" type="submit"> Connexion</button>


        </form>
    </main>
    <?php unset($_SESSION["erreur"]);    ?>
<?php
require_once("include/footer.php");
?>    