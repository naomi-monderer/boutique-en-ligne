<?php
    require_once('include/header.php');
    require_once('../controllers/InscriptionController.php');
    
    if(isset($_POST['submit']))
    {
        $controller = new InscriptionController();
        $controller->registers($_POST['prenom'],$_POST['nom'],$_POST['login'],$_POST['email'],$_POST['password'],$_POST['passwordConfirm'],$_POST['id_droits']); 
       
    }   
?>
<main class="page_inscription">


    
    <section>
    <h1>Inscription</h1>

        <form action="inscription.php" method="post">
        
            <label for="login">Identifiant</label>
            <input type="text" name='login' placeholder="Rosy">

            <label for="prenom">Prénom</label>
            <input type="text" name='prenom' placeholder="Rose ">

            <label for="nom">Nom</label>
            <input type="text" name='nom'placeholder="McGowan">

            <label for="email">Email</label>
            <input type="email" name='email' placeholder="mcgowan@protonmail.com" required>

            <label for="password">Mot de passe</label>
            <input type="password" name='password' placeholder="**********">

            <label for="passwordConfirm">Confirmez le mote de passe</label>
            <input type="password" name='passwordConfirm' placeholder="**********">
            
           <input type="hidden" name="id_droits">

            <input class="btn" type="submit" name="submit" value="valider">
        </form>
    </section>
</main>
<?php
if(isset($_POST['submit']))
{
    echo "<div>" . $_SESSION['error'] . "</div>";
}
require_once('include/footer.php');
?>