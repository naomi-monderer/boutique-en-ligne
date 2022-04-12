<?php
require_once('../controllers/AdminController.php');
// require_once('../controllers/CategorieController.php');
require_once('include/header.php');
$controllerAdmin = new AdminController();

$listCategories = $controllerAdmin->listCategories();
$listAuteurs = $controllerAdmin->listAuteurs();
$miseEnAvant = $controllerAdmin->miseEnAvant();
$showAllCategories = $controllerAdmin->showAllCategoriesInNewCategory();
// var_dump($listAuteurs);
// $auteurNom = $listAuteurs[]['nom'];
// var_dump($auteurNom);

if(isset($_POST['idHidden_article']))
{
    $article = $controllerAdmin->Article($_POST['idHidden_article']);
    echo '<pre>';
    var_dump($article);
    echo '</pre>';
}


// echo '<pre>';
// var_dump($showAllCategories); 
// echo '</pre>';
?>
<main>
    <section>
        <article>
            <h2>Ajouter un nouvel ouvrage:</h2>
        </article>

        <article>
                <form action="" method="post">

                <label for="nom">Nom de l'ouvrage:</label>
                    <input type="text" name="titre" value="<?=$article['titre']?>"> <br/>

                    <label for="auteur">Auteur.ice</label>
                        <select name="auteur">
                            
                            <?php 
                                
                                foreach($listAuteurs as $listAuteur)
                                { 
                                    
                                    // if(count($listAuteur['nom']) && count($listAuteur['prenom']) == 1 )
                                    // {
                            ?>
                                <option value="<?= $listAuteur['id']?>" selected>
                                    <?php echo $listAuteur['nom'] .' '. $listAuteur['prenom']?>
                                </option>

                        <?php 
                                // } 
                            } ?>
                        </select>

                        <!-- doit generer le formulaire pour enregistrer un nouvel auteur-->
                        <p>Vous ne trouvez pas votre auteur dans la liste. Clikez ici</p><br/>

                        <label for="description">Description:</label>
                            <textarea name="description" value="<?=$article['description']?>">
                                <?=$article['description']?>
                            </textarea><br/>

                        <label for="stock"></label>Nombre d'articles à ajouter au stock:</label>
                            <input type="number" name="stock" value="<?=$article['stock']?>"><br/>

                        <label for="prix">Prix:</label>
                            <input type="number" step="0.01" name="prix" value="<?=$article['prix']?>">€<br/>
                        
                        <label for="mise_en_avant">Mettre en avant cet article:</label>
                            <select name='mise_en_avant'>  
                                <option value="1">oui</option>
                                <option value="0">non</option>  
                            </select><br/>
                            
                        <label for="editeur">Editeur:</label>
                            <input type="text" name="editeur" value="<?=$article['editeur']?>"><br/>

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
                        <input type="text" name='image' value="<?=$article['image']?>"placeholder="URL IMG"></br>
                        <img src="<?=$article['image']?>" alt="" style="width:100px">
                    
                    <input type="submit" name="modify_article" value="Modifier cet article">
                    <input type="hidden" name ="idHidden_article" value="<?=$article['id']?>">
                    <?= $article['id']?>
                    <!-- comment générer l'apparition d'un nouvelle catégorie?-->
                </form>
            </article>
            <article>
                <form action="admin_tab_articles.php" method="post">
                    <input type="submit" name="back" value="Retourner au tableau des articles">
                </form>
            </article>
    </section>
</main>
<?php
//    $article = $controllerAdmin->Article($_POST['idHidden_article']);
   if(isset($_POST['modify_article']))
   {    
       //Textes complets 	id	titre	description	stock	prix	mise_en_avant	editeur	id_categorie	id_souscategorie	id_auteur	image
       $id = $_POST['idHidden_article'];
       $modifyArticle= $controllerAdmin->modifyArticle($id,$_POST['titre'],$_POST['description'],$_POST['stock'],$_POST['prix'],$_POST['mise_en_avant'],$_POST['editeur'],$_POST['categorie'],$_POST['souscategorie'],$_POST['auteur'],$_POST['image']);
   }
?>