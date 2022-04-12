<?php
// ob_start();
require_once('../controllers/AdminController.php');
require_once('include/header.php');
$controllerAdmin = new AdminController();
$innerDisplayArticles = $controllerAdmin->tabArticles();

// $allUsers = $controller->displayUsers();
// $allArticles =  $controllerAdmin->displayAllArticles();
// $listAuteurs = $controllerAdmin->listAuteurs();
// $mise_en_avant = $controllerAdmin->miseEnAvant();
// $listCategories = $controllerAdmin->listCategories();
// $showAllCategories = $controllerAdmin->showAllCategoriesInNewCategory();
// $showAllCategoriesInNewCategory = $controllerAdmin->showAllCategoriesInNewCategory();

// echo '<pre>';
// var_dump($innerDisplayArticles);
// echo '</pre>';
// var_dump($allArticles);


?>

<main>
    <section>
    <article>
        
            <h1>Gestion des Articles</h1>
            <table>
                <thead>
                <th>ID</th>
                <th>Image</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Stock</th>
                <th>Prix</th>
                <th>Mise en Avant</th>
                <th>Editeur</th>
                <th>Catégorie</th>
                <th>Sous catégorie</th>
                <th>Auteur.ice</th>
                
                
                <th>MODIFIER</th>
                <th>SUPPRIMER</th>
                </thead>
                <tbody>
                    <?php
                 
                    foreach($innerDisplayArticles as $displayArticle)
                        {          
                        ?> 
                            <tr>
                                <form action="admin_update_article.php" method="get">
                                    
                                    <td>
                                        <p><?=$displayArticle['id'];?></p>
                                    </td>
                                    <td>
                                        <img src="<?= $displayArticle['image'];?>" style="width:40px">
                                   </td>
                                    <td>
                                        <p><?=$displayArticle['titre'];?></p>
                                    </td>
                                    <td>
                                        <p><?=$displayArticle['description'];?></p>
                                    </td>
                                    <td>
                                        <p><?=$displayArticle['stock'];?></p>
                                    </td>
                                    <td>
                                        <p><?=$displayArticle['prix'];?></p>
                                    </td>
                                    <td>
                                        <p><?=$displayArticle['mise_en_avant'];?></p>
                                    </td>
                                    <td>
                                        <p><?=$displayArticle['editeur'];?></p>
                                    </td> 
                                    <td>
                                         <p><?=$displayArticle['nom_categorie'];?></p>
                                    </td>

                                    <td>
                                    <p><?=$displayArticle['nom_souscategorie'];?></p>
                                    </td>
                                    <td>
                                        <p><?=$displayArticle['nom'].''. $displayArticle['prenom'];?></p>
                                    </td>
                                    <td>
                                        <input type="submit" name="modify_article" value="modifier" >  
                                        <input type="hidden" name="idHidden_article" value="<?=$displayArticle['id'];?>" > 
                                    </td>
                                </form>
                                <form action="" method="get">
                                    <td>
                                        <input type="submit" name="delete_article" value="supprimer" >  
                                        <input type="hidden" name="idHidden_article" value="<?=$displayArticle['id'];?>" > 
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
// if (isset($_POST['modify_article']))
// {   
//     // var_dump($_POST);

//     // var_dump($displayArticle['id']);
//     $id = $_POST['idHidden_article'];
//     header('Location: admin_update_article.php');
// }

if(isset($_GET['delete_article']))
{  
    //  var_dump($id);
    $id = $_GET['idHidden_article'];
    $suppArticle = $controllerAdmin->suppArticle($id);

}


// ob_end_flush();
?>
