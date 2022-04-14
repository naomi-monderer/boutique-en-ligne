<?php
ob_start();

require_once('../controllers/AdminController.php');
// require_once('../controllers/CategorieController.php');
require_once('include/header.php');
$controllerAdmin = new AdminController();

//redirection la page index
$secureBackOffice = $controllerAdmin->secureBackOffice();
// if($_SESSION['user'][0]['nom'] != 'admin')
//     header("Location: index.php");

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
<?php require_once('include/sideBar.php')?>
   <div class="contener ">
        <section class="contener-rest">
            <article class="contener-titre-principal">
                    <h2>ENREGISTRER UN NOUVEL OUVRAGE</h2>
            </article>   
            <article class="principal">

                <form class="form-bo" action="" method="post">
                    <div>
                        <label class="label-bo" for="nom">Nom de l'ouvrage:</label>
                            <input class="label-bo" type="text" name="nom" value=""> <br/>

                            <label class="label-bo" for="auteur">Auteur.ice</label>
                                <select class="label-bo" name="auteur">
                                    
                                    <?php foreach($listAuteurs as $listAuteur)
                                    {  ?>

                                        <option value="<?= $listAuteur['id']?>">
                                        
                                            <?php echo $listAuteur['nom'] .' '. $listAuteur['prenom']?>

                                        </option>

                                <?php } ?>
                                </select>

                                <label class="label-bo"  for="description">Description:</label>
                                    <textarea class="label-bo" style="height:20vh;" name="description" value=""></textarea><br/>

                                <label class="label-bo" for="stock">Nombre d'articles à ajouter au stock:</label>
                                    <input class="label-bo" type="number" name="stock" value=""><br/>

                                <label class="label-bo" for="prix">Prix:</label>
                                    <input class="label-bo" type="number" step="0.01" name="prix" value=""><br/>
                    </div>
                    <div>
              
                                
                                <label class="label-bo" for="mise_en_avant">Mettre en avant cet article:</label>
                                    <select class="label-bo" name='mise_en_avant'>  
                                        <option value="1">oui</option>
                                        <option value="0">non</option>  
                                    </select><br/>
                                    
                                <label class="label-bo" for="editeur">Editeur:</label>
                                    <input class="label-bo" type="text" name="editeur" value=""><br/>

                                <label class="label-bo" for="categorie">Catégorie:</label>
                                <select class="label-bo" name="categorie">
                                    <?php foreach($showAllCategories as $showAllCategory) 
                                    {?>   
                                        <option value="<?= $showAllCategory['id']?>">
                                            <?php echo $showAllCategory['nom_categorie']?>
                                        </option>
                                    <?php }?>   
                                </select>
                                    
                                <label class="label-bo" for="souscategorie">Sous-Catégorie:</label>
                                <select class="label-bo" name="souscategorie">
                            
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
                                <input class="label-bo" name='image' placeholder="url de l'image...">
                            
                            <input class="butt-form" type="submit" name="new_article" value="AJOUTER UN LIVRE">
                    </div>
        

                </form>
            </article>
        <?php 
        if(isset($registerArticle))
        {
            echo $registerArticle;
        }
        ?>
     </section>
     </div> 
</main>
<?php
require_once('include/footer.php');
ob_end_flush();
?>  
