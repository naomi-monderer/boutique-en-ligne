<?php
require_once('../controllers/AdminController.php');
require_once('include/header.php');
$controllerAdmin = new AdminController();
$allCategories = $controllerAdmin->showAllCategoriesInNewCategory();
$lists= $controllerAdmin->listCategories();
echo '<pre>';
var_dump($lists);
echo '</pre>';

?>
<main>
    <section>
        <article>
                           
            <h2>Gestion des Categories</h2>
            <table>
                <thead>
                    <th>ID</th>
                    <th>CATÉGORIES</th>
                    <th>MODIFIER</th>
                    <th>SUPPRIMER</th>
                </thead>
                <tbody>
                 
                    <td>
                        <?php
                            foreach($allCategories as $allCategory){

                        ?>        
                           <tr>
                               <form action="" method="post">
                                    <td>
                                        <p><?= $allCategory['id']?></p>
                                    </td>
                                    <td>
                                        <input type="text" name="nom_cat" value="<?= $allCategory['nom_categorie']?>">
                                    </td>
                                    <td>
                                        <input type="submit" name="modify_cat" value="modifier" >  
                                        <input type="hidden" name="idHidden_cat" value="<?=$allArticle['id'];?>" > 
                                    </td>
                                </form>
                                <form action="" method="post">
                                    <td>
                                        <input type="submit" name="delete_cat" value="supprimer" >  
                                        <input type="hidden" name="idHidden_cat" value="<?=$allArticle['id'];?>" > 
                                    </td>
                                </form>
                            </tr>
                    <?php } ?>
                    
                </tbody>
            </table>

            <h2>Gestion des Sous-Categories</h2>
            <table>
                <thead>
                    <th>ID</th>
                    <th>CATÉGORIES</th>
                    <th>SOUS-CATÉGORIES</th>
                    <th>MODIFIER</th>
                    <th>SUPPRIMER</th>
                </thead>
                <tbody>
                    <td>
                        <?php foreach($allCategories as $allCategory)
                            { ?>        
                                <tr>
                                    <form action="" method="post">
                                        <td>
                                            <p><?= $allCategory['id']?></p>
                                        </td>
                                        <td>
                                        <select name="categorie">
                                                <?php foreach($allCategories as $allCategory) 
                                                {?>   
                                                    <option value="<?= $allCategory['id']?>">
                                                        <?php echo $allCategory['nom_categorie']?>
                                                    </option>
                                          <?php }?>   
                                        </select>
                                        </td>
                                        <td>
                                        <?php 
                                        ?>
                                            <input type="text" name="nom_cat" value="<?= $allCategory['nom_categorie']?>">
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
                             <?php 
                            }  ?>
                    
                </tbody>
            </table>
               

                    <input type="submit" name="new_cat" value="Ajouter un nouvelle catégorie">
                </form>
            </article>   

            <article>
                <h2>Ajouter une nouvelle sous-catégorie</h2>
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
                    
                        </select>

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


        <form action="admin.php" method="post">
            <input type="submit" name="back" value="Retourner au menu de gestion">
        </form>
    </article>
    </section>
</main>
