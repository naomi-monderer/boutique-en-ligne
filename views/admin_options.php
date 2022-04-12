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
<main>
    <article>
        <form action="admin.php" method="post">
            <input type="submit" name="back" value="Retourner au menu de gestion">
        </form>
    </article>
    <section>
        <article>               
            <h2>Ajouter une nouvelle catégorie</h2>
            </article>
            <article>
                <form action="" method="post">
                    <label for="nom_cat">Nouveau type de catégorie</label>
                    <input type="text" name="nom_cat"><br/>

                    <input type="submit" name="new_cat" value="Ajouter un nouvelle catégorie">
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
    <section>
        <article>
            <h2>Ajouter une nouvelle sous-catégorie</h2>
        </article>
        <article>
            <form action="" method="post">
                <label for="sous_categorie_select">Catégorie</label>
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
                <label for="nom_sous_cat">Nouveau genre de sous-catégorie</label>
                    <input type="text" name="nom_sous_cat"><br/>
                    <input type="submit" name="new_sous_cat" value="Ajouter une nouvelle sous-catégorie">
            </form>
        </article>
    </section>                  
                <?php 
                    if(isset($registerSousCategorie))
                    {
                    
                        echo $registerSousCategorie;
                    }
                ?>

    <section>
        <article>
            <h2>Auteur.ice</h2>
        </article>
        <article>
            <form action="" method="post">
                <label for="nom_auteur">Nom de l'auteur.ice</label>
                    <input type="text" name="nom_auteur"><br/>

                <label for="prenom_auteur">Prénom de l'auteur.ice</label>
                    <input type="text" name="prenom_auteur"> <br/> 
                <?php    
                    if(isset($registerAuteur))
                    {
                    
                        echo $registerAuteur;
                    }
                ?>

                <input type="submit" name="new_auteur" value="Ajouter l'auteur.ice">   
            </form>
        </article>
    </section>         
</main>
<?php

?>
