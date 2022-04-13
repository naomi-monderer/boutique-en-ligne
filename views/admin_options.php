<?php

require_once('../controllers/AdminController.php');
// require_once('../controllers/CategorieController.php');
require_once('include/header.php');
$controllerAdmin = new AdminController();

$showAllCategoriesInNewCategory = $controllerAdmin->showAllCategoriesInNewCategory();
$listCategories = $controllerAdmin->listCategories();
$listAuteurs = $controllerAdmin->listAuteurs();
$miseEnAvant = $controllerAdmin->miseEnAvant();
$showAllCategories = $controllerAdmin->showAllCategoriesInNewCategory();

   
if(isset($_POST['new_cat']))
{   
    $registerCategorie = $controllerAdmin->registerCategorie($_POST['nom_cat']);
}


if(isset($_POST['new_sous_cat']))
{   
    $id_categorie = $_POST['sous_categorie_select'];
    $registerSousCategorie = $controllerAdmin->registerSousCategorie($_POST['nom_sous_cat'], $id_categorie);
}


if(isset($_POST['new_auteur']))
{
    $registerAuteur = $controllerAdmin->registerAuteur($_POST['nom_auteur'],$_POST['prenom_auteur']);
}  
?>
<main class="main-bo">


    <?php require_once('include/sideBar.php')?>
    <div class="contener">
        <section id="contener-rest" class="contener-rest-options">

     
    <section class="child-contener-rest">
        <article class="contener-titre-principal">               
            <h2>NOUVEAU GENRE</h2>
            </article>
            <article>
                <form class="form-bo" action="" method="post">
                    <label for="nom_cat">Genre:</label>
                    <input type="text" name="nom_cat"><br/>

                    <input class="butt-form" type="submit" name="new_cat" value="AJOUTER UN GENRE">
                </form>
            </article>
    </section>        
            <?php 
                // var_dump($registerCategorie);
                if(isset($registerCategorie))
                {
                    echo $registerCategorie;
                }
            ?>
    <section class="child-contener-rest">
        <article class="contener-titre-principal">
            <h2>NOUVELLE SOUS-GENRE</h2>
        </article>
        <article>
            <form class="form-bo" action="" method="post">
                <label for="sous_categorie_select">Genre:</label>
                    <select name="sous_categorie_select">
                    <!-- foreach de option pour chaque ligne de categorie  -->
                        <?php  
                                if (isset($showAllCategoriesInNewCategory))
                                {    
                                    foreach($showAllCategoriesInNewCategory as $category)
                                    { ?>
                                        <option value="<?php echo $category['id']; ?>">

                                        <?php   echo $category['nom_categorie'];?>
                                        </option> 
                        <?php       }
                                }
                        ?>
                
                    </select><br/>
                <label for="nom_sous_cat">Sous-Genre:</label>
                    <input type="text" name="nom_sous_cat"><br/>
                    <input class="butt-form" type="submit" name="new_sous_cat" value="AJOUTER UN SOUS-GENRE">
            </form>
        </article>
    </section>                  
                <?php 
                    if(isset($registerSousCategorie))
                    {
                    
                        echo $registerSousCategorie;
                    }
                ?>

    <section class="child-contener-rest">
        <article class="contener-titre-principal">
            <h2>AUTEUR.ICE</h2>
        </article>
        <article>
            <form class="form-bo" action="" method="post">
                <label for="nom_auteur">Nom:</label>
                    <input type="text" name="nom_auteur"><br/>

                <label for="prenom_auteur">Prénom:</label>
                    <input type="text" name="prenom_auteur"> <br/> 
                <?php    
                    if(isset($registerAuteur))
                    {
                    
                        echo $registerAuteur;
                    }
                ?>

                <input class="butt-form" type="submit" name="new_auteur" value="AJOUTER UN.E AUTEUR.ICE">   
            </form>
        </article>
        </section>
        
    </section> 
    </div>        
</main>
<?php
require_once('include/footer.php');

?>
