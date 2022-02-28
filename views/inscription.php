<?php

    require('../controllers/traitement-inscription.php');
    if(isset($_POST['submit']))
    {
        $controller = new UserController();
        $var = $controller->registers($_POST['prenom'],$_POST['nom'],$_POST['login'],$_POST['email'],$_POST['password'],$_POST['passwordConfirm']);   
    }
    
    
 ?>

<h1>Inscription</h1>
<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Incidunt fugit consequuntur culpa quae rem totam, architecto perferendis sapiente sint consequatur asperiores pariatur velit? Fugiat asperiores excepturi, molestiae ducimus animi culpa.</p>

<form action="inscription.php" method="post">

    <label for="prenom">Prénom</label>
    <input type="text" name='prenom'>

    <label for="nom">Nom</label>
    <input type="text" name='nom'>

    <label for="login">Identifiant</label>
    <input type="text" name='login'>

    <label for="email">Email</label>
    <input type="text" name='email'>

    <label for="password">Mot de passe</label>
    <input type="text" name='password'>

    <label for="passwordConfirm">Confirmez le mote de passe</label>
    <input type="text" name='passwordConfirm'>


    <input type="submit" name="submit" value="valider">
</form>
<?php
if(isset($_POST['submit']))
{
    echo "<div> $var </div>";
}
?>    


