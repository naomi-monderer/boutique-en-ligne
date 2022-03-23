<?php
require_once('../controllers/AdminController.php');
// require_once('../controllers/CategorieController.php');
require_once('include/header.php');
$controllerAdmin = new AdminController();
$showAllCategoriesInNewCategory = $controllerAdmin->showAllCategoriesInNewCategory();


?>
<main>
    <h1> Afficher la liste des articles</h1>
   
<article>
    <h2>Enregistrer un nouvel ouvrage</h2>
        <form action="" method="post">

            <label for="nom">Nom de l'ouvrage</label>
                <input type="text" name="nom" value=""> <br/>

                <label for="auteur">Auteur.ice</label>
                    <select name="auteur">
                        <option value="choose">Séléctionner l'auteur.ice</option>
                    </select>
                    <!-- doit generer le formulaire pour enregistrer un nouvel auteur-->
                    <p>Vous ne trouvez pas votre auteur dans la liste. Clikez ici</p><br/>

                <label for="description">Description</label>
                    <input textarea name="description" value=""><br/>

                <label for="stock"></label>Nombre d'article à ajouter au stock</label>
                    <input type="number" name="stock" value=""><br/>

                <label for="prix">Prix</label>
                    <input type="number" name="prix" value="">€<br/>
                
                <label for="mise_en_avant">Mettre en avant cet article</label>
                    <select name="mise_en_avant">
                        <option value="choose">Séléctionner une option</option>    
                        <option value="yes">oui</option>
                        <option value="no">non</option>  
                    </select><br/>
                    
                <label for="editeur">Editeur</label>
                    <input type="text" name="editeur" value=""><br/>

                <label for="categorie">Catégorie</label>
                <select name="categorie">
                    <option value="choose">Séléctionner une catégorie</option> 
                </select><br/>

                <label for="image">Choisir une image </label>
                <div>
                    <a href="article.php?id=<?php echo $resultat['id']?>">
                        <img src="../picture/<?php echo $resultat["image"]; ?>" alt="">
                    </a>
                    
                </div>
                
                <input type="submit" name="new_categorie" value="Ajouter un nouvel article">
                <!-- comment générer l'apparition d'un nouvelle catégorie?-->
            </form>
        </article>

        <article>
            <h2>Ajouter une nouvelle catégorie</h2>
                <form action="" method="post">
                    <label for="nom_cat">Nouveau type de catégorie</label>
                    <input type="text" name="nom_cat"><br/>

                    <input type="submit" name="new_cat" value="Ajouter un nouvelle catégorie">
                </form>
               
            <h2>Ajouter une nouvelle sous-catégorie</h2>
                <form action="" method="post">
                <label for="categorie">Catégorie</label>
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
                  <?php }
                   }
                    ?>
                   
                </select><br/>

                    <label for="nom_sous_cat">Nouveau genre de sous-catégorie</label>
                    <input type="text" name="nom_sous_cat"><br/>

                    <input type="submit" name="new_sous_cat" value="Ajouter une nouvelle sous-catégorie">
                </form>    
        </article>

        <article>
        <h2>Auteur.ice</h2>
                <form action="" method="post">
                    <label for="nom_auteur">Nom de l'auteur.ice</label>
                        <input type="text" name="nom_auteur"><br/>

                    <label for="prenom_auteur">Prénom de l'auteur.ice</label>
                        <input type="text" name="prenom_auteur"> <br/> 

                        <input type="submit" name="new_auteur" value="Ajouter l'auteur.ice">   
                </form>
        </article>

        <article>
            <form action="admin.php" method="post">
                <input type="submit" name="back" value="Retourner au menu de gestion">
            </form>
        </article>
    </section>
</main>
<?php

if(isset($_POST['new_cat']))
{   
    $registerCategorie = $controllerAdmin->registerCategorie($_POST['nom_cat']);
}
if(isset($_POST['new_sous_cat']))
{   

    // $_POST['sous_categorie_select'] = $category['id'];
    // $id_categorie = $category['id'];
    $id_categorie = $_POST['sous_categorie_select'];
    // $id_categorie = $category['id'];
    // $_POST['sous_categorie_select'] = $id_categorie;
    $registerSousCategorie = $controllerAdmin->registerSousCategorie($_POST['nom_sous_cat'], $id_categorie);

}


if(isset($_POST['new_auteur']))
{
    $registerAuteur = $controllerAdmin->registerAuteur($_POST['nom_auteur'],$_POST['prenom_auteur']);
}



if(isset($_POST['back']))
{
    header('location:admin.php');
}
?>    

