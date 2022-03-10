<?php
    require_once('include/header.php');
    require_once('../controllers/ProfilController.php');
    
    if(isset($_POST['submit']))
    {
        $controller = new ProfilController();
        $var = $controller->update($_POST['prenom'],$_POST['nom'],$_POST['login'],$_POST['email'],$_POST['password'],$_POST['passwordConfirm'],$_POST['id_droits']); 
       
    } 
    
    $id = $_SESSION['user'][0]['id'];

    $controllerUser = new UserModel();
    $dataUser = $controllerUser->getUserById($id);
   
?>
<main>
    <section>
    <h1>Mon profil</h1>

        <form action="" method="post">
        
            <label for="login">Identifiant</label>
            <input type="text" name='login'  value="<?= $dataUser['login']?>">

            <label for="prenom">Prénom</label>
            <input type="text" name='prenom' value="<?= $dataUser['prenom']?>">

            <label for="nom">Nom</label>
            <input type="text" name='nom' value="<?= $dataUser['nom']?>">

            <label for="email">Email</label>
            <input type="text" name='email' value="<?= $dataUser['email']?>">

            <label for="password">Mot de passe</label>
            <input type="text" name='password' placeholder="...........">

            <label for="passwordConfirm">Confirmez le mote de passe</label>
            <input type="text" name='passwordConfirm' placeholder="..........">

            <input type="hidden" name="id_droits">

            <input type="submit" name="submit" value="valider">
        </form>
    </section>
</main>
<?php
if(isset($_POST['submit']))
{
    echo "<div> $var </div>";
}
?>    


