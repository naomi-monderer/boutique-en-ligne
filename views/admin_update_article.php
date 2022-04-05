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

    echo '<pre>';
    // var_dump($listCategories); 
    var_dump($_POST);
    // var_dump($_SESSION);
    echo '</pre>';

// echo '<pre>';
// var_dump($showAllCategories); 
// echo '</pre>';
?>
<main>
    <h1> Ajouter des Articles</h1>
   
<article>
    <h2>Enregistrer un nouvel ouvrage:</h2>
        <form action="" method="post">

            <label for="nom">Nom de l'ouvrage:</label>
                <input type="text" name="nom" value=""> <br/>

                <label for="auteur">Auteur.ice</label>
                    <select name="auteur">
                        
                        <?php foreach($listAuteurs as $listAuteur)
                        {  ?>

                            <option value="<?= $listAuteur['id']?>">
                               
                                <?php echo $listAuteur['nom'] .' '. $listAuteur['prenom']?>

                            </option>

                    <?php } ?>
                    </select>

                    <!-- doit generer le formulaire pour enregistrer un nouvel auteur-->
                    <p>Vous ne trouvez pas votre auteur dans la liste. Clikez ici</p><br/>

                    <label for="description">Description:</label>
                        <textarea name="description" value=""></textarea><br/>

                    <label for="stock"></label>Nombre d'articles à ajouter au stock:</label>
                        <input type="number" name="stock" value=""><br/>

                    <label for="prix">Prix:</label>
                        <input type="number" step="0.01" name="prix" value="">€<br/>
                    
                    <label for="mise_en_avant">Mettre en avant cet article:</label>
                        <select name='mise_en_avant'>  
                            <option value="oui">oui</option>
                            <option value="non">non</option>  
                        </select><br/>
                        
                    <label for="editeur">Editeur:</label>
                        <input type="text" name="editeur" value=""><br/>

                    <label for="categorie">Catégorie:</label>
                    <select name="categorie">
                        <?php foreach($showAllCategories as $showAllCategory) 
                        {?>   
                            <option value="<?= $showAllCategory['id']?>">
                                <?php echo $showAllCategory['nom_categorie']?>
                            </option>
                        <?php }?>   
                    </select>
                        
                    <label for="souscategorie">Sous-Catégorie:</label>
                    <select name="souscategorie">
                
                        <?php 
                        $temp="";  
                        $booleen = true;
                        foreach($listCategories as $listCategory) 
                        { ?>
                            <?php   if($temp == $listCategory['nom_categorie'])
                                    { ?>
                                        <option value="<?= $listCategory['id']?>"> 
                                            <?php  echo $listCategory['nom_souscategorie']?>
                                        </option>
                        <?php    
                                        $booleen = true; // :)
                                    }
                                    else
                                    {?>
                                        
                                        <optgroup  value="<?= $listCategory['id_categorie']?>" label="<?php echo $listCategory['nom_categorie']?>">
                                        <option value="<?= $listCategory['id']?>"> 
                                            <?php  echo $listCategory['nom_souscategorie']?>
                                        </option>
                                        <?php if($booleen == false) // :D
                                        echo '</optgroup>'; ?>                                 
                            <?php }?>
                                
                        <?php 
                                $temp = $listCategory['nom_categorie'];
                        }?>
                    </select><br/>

                <label for="image">Choisir une image:</label>
                    <input type="text" name='image' placeholder="URL IMG">
                
                <input type="submit" name="new_article" value="Ajouter un nouvel article">
                <!-- comment générer l'apparition d'un nouvelle catégorie?-->
            </form>
        </article>
        <article>
            <form action="admin.php" method="post">
                <input type="submit" name="back" value="Retourner au menu de gestion">
            </form>
        </article>
    </section>
</main>