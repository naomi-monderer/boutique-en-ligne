<?php
ob_start();
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
    // var_dump($listCategories); 
    // var_dump($_POST);
    // var_dump($_SESSION);
    echo '</pre>';

// echo '<pre>';
// var_dump($showAllCategories); 
// echo '</pre>';
if(isset($_POST['new_article']))
{
$registerArticle = $controllerAdmin->registerArticle($_POST['nom'],$_POST['description'],
                                                    $_POST['stock'],$_POST['prix'],$_POST['mise_en_avant'],
                                                    $_POST['editeur'],$_POST['categorie'],$_POST['souscategorie'],
                                                    $_POST['auteur'], $_POST['image']);
}
if(isset($_POST['back']))
{
    header('location:admin.php');
}
?>
<main class="main-bo">
    <section class="contener-bo">
        <article class="nav-bo">
            <div class="contener-titre-bo">
                <h1 class="titre-bo"><a href="admin.php">BACK OFFICE</a></h1>
            </div>

            <div class="contener-liste-bo">
                <ul class="ul-nav-bo">
                    <li class="liste-bo">
                        <a href="admin_user.php">Gestions des utilisateurs</a>
                    </li>
                    <li class="liste-bo">
                        <i></i>
                        <a href="admin_article.php">Nouvel Article</a>
                    </li>
                    <li class="liste-bo">
                        <i></i>
                        <a href="admin_tab_articles.php">Gestion des Articles</a>
                    </li>
                    <li class="liste-bo">
                        <i></i> 
                        <a href="admin_options.php">Nouvelles Options</a>
                    </li>
                    <li class="liste-bo">
                        <i></i>
                    <a href="admin_manage_other_forms.php">Gestions des options</a>
                    </li>
                </ul>
            </div>  
        </article>
    </section>

    <section class="contener-rest">
        <article class="contener-titre-principal">
                <h2>Enregistrer un nouvel ouvrage</h2>
        </article>   
        <article class="principal">
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
                                        <option value="1">oui</option>
                                        <option value="0    ">non</option>  
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
                    <?php 
                    if(isset($registerArticle))
                    {
                        echo $registerArticle;
                    }
                ?>
     </section>
</main>
<?php


ob_end_flush();

?>  
