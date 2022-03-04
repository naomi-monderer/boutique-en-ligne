<?php
require_once('include/header.php');
require_once('../controllers/ConnexionController.php');

if(isset($_POST['submit']))
{
    $controller = new ConnexionController();
    $check = $controller->connexion($_POST['login'], $_POST['password']);
}
?>
<main>
    <section>
        <h1>Connexion</h1>
        <form action="" method="post">
            <div>
                <label for="login">Votre login</label>
                <input type="text" name="login" id="login">
            </div>
            <div>
                <label for="password">Votre password</label>
                <input type="password" name="password" id="password">
            </div>

            <input type="submit" name="submit" value="valider">
        </form>
    </section>     
</main>
<?php
if(isset($_POST['submit']))
{
    echo "<div> $check </div>";
}   
require_once("include/footer.php");
?>    