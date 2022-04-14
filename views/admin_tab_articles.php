<?php
// ob_start();
require_once('../controllers/AdminController.php');
require_once('include/header.php');
$controllerAdmin = new AdminController();
$innerDisplayArticles = $controllerAdmin->tabArticles();

//redirection la page index
$secureBackOffice = $controllerAdmin->secureBackOffice();

?>

<main class="main-bo">
    <?php #require_once('include/sideBar.php')?>
    <article>
        <form  action="admin.php" method="post">
        <i class="fa-solid fa-arrow-left-from-line"></i>
            <input class="butt-tab" type="submit" name="back" value="">
        </form>
    </article>
    <section class="tab-contener">
 

        <article class="contener-titre-principal" >
            <h1> Consulter les livres enregistrés dans ma boutique</h1>
        </article> 
        <article>
            <table class="tab-articles">
                <thead class="thead-articles">
                    <th>ID</th>
                    <th>Image</th>
                    <th>Titre</th>
                    <th class="th-description">Description</th>
                    <th>Stock</th>
                    <th>Prix</th>
                    <th>Mise en Avant</th>
                    <th>Editeur</th>
                    <th>Catégorie</th>
                    <th>Sous-catégorie</th>
                    <th>Auteur.ice</th>
                </thead>
                <tbody class="tbody-articles">
                    <?php 
                        foreach($innerDisplayArticles as $displayArticle)
                        {          
                    ?> 
                        <tr class="tr-articles">
                            <form action="admin_update_article.php" method="get">
                                
                                <td class="td-articles">
                                    <p><?=$displayArticle['id'];?></p>
                                </td>
                                <td class="td-articles">
                                    <img style="width: 100px"src="<?= $displayArticle['image'];?>">
                                </td>
                                <td class="td-articles">
                                    <p><?=$displayArticle['titre'];?></p>
                                </td>
                                <td class="td-articles">
                                    <p><?=$displayArticle['description'];?></p>
                                </td>
                                <td class="td-articles">
                                    <p><?=$displayArticle['stock'];?></p>
                                </td>
                                <td class="td-articles">
                                    <p><?=$displayArticle['prix'];?></p>
                                </td>
                                <td class="td-articles">
                                    <p><?=$displayArticle['mise_en_avant'];?></p>
                                </td>
                                <td class="td-articles">
                                    <p><?=$displayArticle['editeur'];?></p>
                                </td> 
                                <td class="td-articles">
                                    <p><?=$displayArticle['nom_categorie'];?></p>
                                </td>

                                <td class="td-articles">
                                <p><?=$displayArticle['nom_souscategorie'];?></p>
                                </td>
                                <td class="td-articles">
                                    <p><?=$displayArticle['nom'].' '. $displayArticle['prenom'];?></p>
                                </td>
                                <td class="td-articles">
                                <button class="butt-modif" type="submit" name="modify_article" ><i class="fa-solid fa-screwdriver-wrench"></i></button>
                                <input type="hidden" name="idHidden_article" value="<?=$displayArticle['id'];?>" > 
                                </td>
                            </form>
                            <form action="" method="get">
                                <td class="td-articles">
                                    <button class="butt-delete" name="delete_article" type='submit'><i class="fa-solid fa-xmark"></i></button>  
                                    <input type="hidden" name="idHidden_article" value="<?=$displayArticle['id'];?>" > 
                                </td>
                            </form>
                        </tr>
                <?php } ?>
                    </tbody>    
                </table>
        </article>
    </section>       
</main>
<?php


if(isset($_GET['delete_article']))
{  
    //  var_dump($id);
    $id = $_GET['idHidden_article'];
    $suppArticle = $controllerAdmin->suppArticle($id);

}
require_once('include/footer.php');

// ob_end_flush();
?>
