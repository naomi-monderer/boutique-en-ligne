<?php
ob_start();
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


if(isset($_GET['idHidden_article']))
{

    $article = $controllerAdmin->Article($_GET['idHidden_article']);
    // echo '<pre>';
    // var_dump($article);
    // echo '</pre>';
}
if(isset($_POST['modify_article']))
{    
    //Textes complets 	id	titre	description	stock	prix	mise_en_avant	editeur	id_categorie	id_souscategorie	id_auteur	image
    $id = $_POST['idHidden_article'];
    @$modifyArticle = $controllerAdmin->modifyArticle($id,$_POST['titre'],$_POST['description'],$_POST['stock'],$_POST['prix'],$_POST['mise_en_avant'],$_POST['editeur'],$_POST['categorie'],$_POST['souscategorie'],$_POST['auteur'],$_POST['image']);
    // header('Location: admin_update_article.php');
}
?>
<main class="main-bo">

    <?php require_once('include/sideBar.php')?>
    <div class="contener">
        <section class="contener-rest">
            
        <article class="contener-titre-principal">
            <h1> Modification des articles</h1>
            </article>
            <article class="principal">
                <form  class="form-bo" action="" method="POST">
                    <div>
                        <label class="label-bo" for="nom">Nom de l'ouvrage:</label>
                            <input class="label-bo"  type="text" name="titre" value="<?=$article['titre']?>"> <br/>

                            <label class="label-bo" for="auteur">Auteur.ice</label>
                                <select name="auteur">
                                    
                                    <?php 
                                        
                                        foreach($listAuteurs as $listAuteur)
                                        { 
                                            
                                    ?>
                                        <option value="<?= $listAuteur['id']?>" selected>
                                            <?= $listAuteur['nom'] .' '. $listAuteur['prenom']?>
                                        </option>

                                <?php 
                                    } ?>
                                </select>

                                <label class="label-bo" for="description">Description:</label>
                                    <textarea class="label-bo" style="height:20vh;" name="description" value="<?=$article['description']?>">
                                        <?=$article['description']?>
                                    </textarea><br/>

                                <label class="label-bo" for="stock">Stock:</label>
                                    <input class="label-bo"  type="number" name="stock" value="<?=$article['stock']?>"><br/>
                                
                                <label class="label-bo" for="prix">Prix:</label>
                                <input class="label-bo"  type="number" step="0.01" name="prix" value="<?=$article['prix']?>"><br/>
                        
                        
                    </div>
                    <div>
                        <label class="label-bo" for="mise_en_avant">Mettre en avant:</label>
                                <select name='mise_en_avant'>  
                                    <option value="1">oui</option>
                                    <option value="0">non</option>  
                                </select><br/>
                                    
                            <label class="label-bo" for="editeur">Editeur:</label>
                                <input class="label-bo"  type="text" name="editeur" value="<?=$article['editeur']?>"><br/>

                            <label class="label-bo" for="categorie">Catégorie:</label>
                            <select name="categorie">
                                <?php foreach($showAllCategories as $showAllCategory) 
                                {?>   
                                    <option value="<?= $showAllCategory['id']?>">
                                        <?php echo $showAllCategory['nom_categorie']?>
                                    </option>
                                <?php }?>   
                            </select>
                                
                            <label class="label-bo" for="souscategorie">Sous-Catégorie:</label>
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

                        <label class="label-bo" for="image">Choisir une image:</label>
                            <div class="modif-image"> 
                                <input class="label-bo"  type="text" name='image' value="<?=$article['image']?>"placeholder="url de l'image...">
                                <img src="<?=$article['image']?>" alt="" style="width:100px">
                            </div>
                        
                        <input type="submit" name="modify_article" value="Modifier cet article">
                        <input type="hidden" name ="idHidden_article" value="<?=$article['id']?>">
                    </div>
                </form>
                </article>
                                <?php
                                    if(isset($modifyArticle))
                                    {
                                        echo $modifyArticle;
                                    }   
                                ?>
            
        </section>
    </div>
</main>
<?php
require_once('include/footer.php');
ob_end_flush();
  
?>