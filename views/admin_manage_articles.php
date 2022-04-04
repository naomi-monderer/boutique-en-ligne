<?php
require_once('../controllers/AdminController.php');
require_once('include/header.php');
$controllerAdmin = new AdminController();
// $allUsers = $controller->displayUsers();
$allArticles =  $controllerAdmin->displayAllArticles();
$listAuteurs = $controllerAdmin->listAuteurs();
$mise_en_avant = $controllerAdmin->miseEnAvant();
$listCategories = $controllerAdmin->listCategories();
$showAllCategories = $controllerAdmin->showAllCategoriesInNewCategory();
$showAllCategoriesInNewCategory = $controllerAdmin->showAllCategoriesInNewCategory();

echo '<pre>';
// var_dump($listAuteurs);
echo '</pre>';
// var_dump($allArticles);

//Textes complets 	
// id	titre 
// description
// 	stock
//     	prix
//         	mise_en_avant
//             	editeur
//                 	id_categorie
//                     	id_souscategorie
//                         	id_auteur
//                             	image
?>
<main>
    <section>
    <article>
        
            <h1>Gestion des Articles</h1>
            <table>
                <thead>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Stock</th>
                <th>Prix</th>
                <th>Mise en Avant</th>
                <th>Editeur</th>
                <th>Catégorie</th>
                <th>Sous catégorie</th>
                <th>Auteur.ice</th>
                <th>Image</th>
                
                <th>MODIFIER</th>
                <th>SUPPRIMER</th>
                </thead>
                <tbody>
                    <?php
                 
                    foreach($allArticles as $allArticle)
                        {          
                        ?> 
                            <tr>
                                <form action="" method="POST">
                                    <td>
                                        <p><?=$allArticle['id'];?></p>
                                    </td>
                                    <td>
                                    <input type="text" name="nom" value="<?= $allArticle['titre']?>">
                                    </td>
                                    <td>
                                        <input type="text" name="description" value="<?=$allArticle['description'];?>">      
                                    </td>
                                    <td>
                                        <input type="number" name="stock" value="<?=$allArticle['stock'];?>">      
                                    </td>
                                    <td>
                                        <input type="number" name="prix" value="<?=$allArticle['prix'];?>">      
                                    </td>
                                    
                                    <td>
                                        <!-- SELECT-->
                                        <select name='mise_en_avant'>  
                                            <option value="1">oui</option>
                                            <option value="0">non</option>  
                                        </select><br/>
                                    </td>
                                    <td>
                                        <input type="text" name="editeur" value="<?=$allArticle['editeur'];?>">
                                    </td> 
                                    <td>
                                         <!-- SELECT-->
                                         <select name="categorie">
                                            <?php foreach($showAllCategories as $showAllCategory) 
                                            {?>   
                                                <option value="<?= $showAllCategory['id']?>">
                                                        <?php echo $showAllCategory['nom_categorie']?>
                                                </option>
                                            <?php }?>   
                                        </select>
                                    </td>
                                    <td>
                                         <!-- SELECT-->
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
                                    </td>
                                    <td>
                                         <!-- SELECT-->
                              
                                       
                                        <select name="auteur">
                        
                                            <?php foreach($listAuteurs as $listAuteur)
                                            {  ?>

                                                <option value="<?= $listAuteur['id']?>">
                                                
                                                    <?php echo $listAuteur['nom'] .' '. $listAuteur['prenom']?>

                                                </option>

                                        <?php } ?>
                                    </td>
                                    <td>
                                        
                                        <input type="text" name="image" value="<?=$allArticle['image'];?>">
                                    </td>
            
                                    <td>
                                        <input type="submit" name="modify_user" value="modifier" >  
                                        <input type="hidden" name="idHidden_user" value="<?=$allArticle['id'];?>" > 
                                    </td>
                                </form>
                                <form action="" method="post">
                                    <td>
                                        <input type="submit" name="delete_user" value="supprimer" >  
                                        <input type="hidden" name="idHidden_user" value="<?=$allArticle['id'];?>" > 
                                    </td>
                                </form>
                            </tr>
                    <?php } ?>
                </tbody>    
            </table>
        </article>

    <article>
        <form action="admin.php" method="post">
            <input type="submit" name="back" value="Retourner au menu de gestion">
        </form>
    </article>
    </section>
</main>
<?php
