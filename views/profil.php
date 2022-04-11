<?php
    require_once('include/header.php');
    require_once('../controllers/ProfilController.php');
    // require_once('../controllers/CommandeConstroller.php');


    $controller = new ProfilController();

    $id = $_SESSION['user'][0]['id'];
    $dataUser = $controller->recupId($id);

    if(isset($_POST['submitLogin']))
    {
        
        $controller->modifyLogin($_POST['login']);  
    }

    if(isset($_POST['submitEmail']))
    {
        
        $controller->modifyEmail($_POST['email']); 
    } 

    if(isset($_POST['submitPass']))
    {
        
        $controller->modifyPassword($_POST['password'],$_POST['passwordConfirm']); 
    } 
   
?>

<main>

    <h1>Mon profil</h1>

    <section>

        <form action="" method="post">
        
            <label for="login">Login</label>
            <input type="text" name='login'  value="<?= $dataUser[0]['login']?>">

            <input type="submit" name="submitLogin" value="Modifier">
        </form>

        <form action="" method="post">
        
            <label for="email">Email</label>
            <input type="email" name='email'  value="<?= $dataUser[0]['email']?>">

            <input type="submit" name="submitEmail" value="Modifier">
        </form>

        <form action="" method="post">
        
        <label for="password">Mot de passe</label>
        <input type="password" name='password'  placeholder="********">

        <label for="password">Confirmez le mot de passe</label>
        <input type="password" name='passwordConfirm'  placeholder="********">
        
        <input type="submit" name="submitPass" value="Modifier">
    </form>
    </section>

</main>

<?php
if(isset($_POST['submitLogin']) || isset($_POST['submitEmail']) || isset($_POST['submitPass']))
{
    echo "<div>" . $_SESSION['error'] . "</div>";
}

?>  