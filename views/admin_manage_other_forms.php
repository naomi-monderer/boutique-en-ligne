<?php
ob_start();
require_once('../controllers/AdminController.php');
require_once('include/header.php');

$controllerAdmin = new AdminController();

$allCategories = $controllerAdmin->showAllCategoriesInNewCategory();
$lists= $controllerAdmin->listCategories();
$listAuteurs= $controllerAdmin->listAuteurs();

/* Categories*/ 
if(isset($_POST['delete_categorie']))
{
    $id=$_POST['idHidden_categorie'];
    $suppCategorie = $controllerAdmin->suppCategorie($id);
}

if(isset($_POST['modify_categorie']))
{
    $id=$_POST['idHidden_categorie'];
    $modifyCategorie = $controllerAdmin->modifyCategorie($id,$_POST['nom_cat']);

}

/* Auteurs*/ 
if(isset($_POST['delete_auteur']))
{   
    $id = $_POST['idHidden_auteur'];
    $suppAuteur= $controllerAdmin->suppAuteur($id);
}

if(isset($_POST['modify_auteur']))
{   
    $id = $_POST['idHidden_auteur'];
    $modifyAuteur= $controllerAdmin->modifyAuteur($id,$_POST['nom_auteur'],$_POST['prenom_auteur']);
    // header('location: admin_manage_other_forms.php');
}

/* Sous-Catégories*/ 
if(isset($_POST['delete_souscategorie']))
{ 
    $id = $_POST['idHidden_souscategorie'];
    $suppSousCategorie = $controllerAdmin->suppSousCategorie($id);
}
if(isset($_POST['modify_souscategorie']))
{ 
    $id = $_POST['idHidden_souscategorie'];
    $modifySousCategorie= $controllerAdmin->modifySousCategorie($id, $_POST['idHidden_cat'],$_POST['sous-cat']);

}
?>
<main>
    <section>
        <article>
            <form action="admin.php" method="post">
                <input type="submit" name="back" value="Retourner au menu de gestion">
            </form>
        </article>
        <article>
            <table>
                <h2>Gestion des Categories</h2>
                <thead>
                    <th>ID</th>
                    <th>CATÉGORIES</th>
                   
                </thead>
                <tbody>
                 
                    <td>
                        <?php
                            foreach($allCategories as $category){

                        ?>        
                           <tr>
                               <form action="" method="post">
                                    <td>
                                        <p><?= $category['id']?></p>
                                    </td>
                                    <td>
                                        <input type="text" name="nom_cat" value="<?= $category['nom_categorie']?>">
                                    </td>
                                    <td>
                                        <input type="submit" name="modify_categorie" value="modifier" >  
                                        <input type="hidden" name="idHidden_categorie" value="<?=$category['id'];?>" > 
                                    </td>
                                </form>
                                <form action="" method="post">
                                    <td>
                                        <input type="submit" name="delete_categorie" value="supprimer" >  
                                        <input type="hidden" name="idHidden_categorie" value="<?=$category['id'];?>" > 
                                        
                                    </td>
                                </form>
                            </tr>
                    <?php  } ?>
                </tbody> 
                <?php
                    //Gestion des erreurs.    
                        if(isset($modifyCategorie))
                        {
                            
                                echo $modifyCategorie;
                        }
                    ?>                 
            </table>
        </article>
       
        <table>
                <h2>Gestion des Sous-Categories</h2>
                <thead>
                    <th>ID</th>
                    <th>CATÉGORIES</th>
                    <th>SOUS-CATÉGORIES</th>
                   
                </thead>
                <tbody>
                    <td>
                
                        <?php foreach($lists as $list)
                            { 
                                // ce foreach vient du fetch de la fonction ListCategories qui a pour requete innerjoin dans modelArticle
                                ?>        
                                <tr>
                                    <form action="" method="post">
                                        <td>
                                            <p><?= $list['id_categorie'];?></p>
                                        </td>
                                        <td>
                                            <p><?= $list['nom_categorie'];?></p>
                                        </td>
                                        <td>
                                            <input type="text" name="sous-cat" value="<?= $list['nom_souscategorie'];?>">
                                        </td>    
                                     
                                        <td>
                                            <input type="submit" name="modify_souscategorie" value="modifier" >  
                                            <input type="hidden" name="idHidden_souscategorie" value="<?=$list['id'];?>" > 
                                            <input type="hidden" name="idHidden_cat" value="<?=$list['id_categorie'];?>" > 
                                        </td>
                                    </form>
                                    <form action="" method="post">
                                        <td>
                                            <input type="submit" name="delete_souscategorie" value="supprimer" >  
                                            <input type="hidden" name="idHidden_souscategorie" value="<?=$list['id'];?>" > 
                                            
                                        </td>
                                    </form>
                                </tr>
                             <?php 
                            }  ?>
                                
                </tbody>
                <?php  
                                    
                                    //Gestion des erreurs. 
                                    if(isset($modifySousCategorie))
                                    {   
                                        echo $modifySousCategorie;
                                    }
                                ?>
            </table>

            <article>
                
                <h2> Gestion des Auteur.ices</h2>
                <table>
                    <thead>
                        <th>ID</th>
                        <th>NOM</th>
                        <th>PRENOM</th>
                    </thead>
                    <tbody>
                        <?php foreach($listAuteurs as $listAuteur)
                                { ?>
                                    <tr>
                                        <form action="admin_manage_other_forms.php" method="post">
                                            <td>
                                                <p><?= $listAuteur['id']?></p>
                                            </td>
                                            <td>
                                                <input type="text" name="nom_auteur" value="<?= $listAuteur['nom']?>">
                                            </td>
                                            <td>
                                            <input type="text" name="prenom_auteur" value="<?= $listAuteur['prenom']?>">
                                            </td>
                                            <td>
                                                <input type="submit" name="modify_auteur" value="modifier" >  
                                                <input type="hidden" name="idHidden_auteur" value="<?=$listAuteur['id'];?>" > 
                                            </td>
                                        </form>
                                        <form action="" method="post">
                                            <td>
                                                <input type="submit" name="delete_auteur" value="supprimer" >  
                                                <input type="hidden" name="idHidden_auteur" value="<?=$listAuteur['id'];?>" > 
                                               
                                            </td>
                                        </form>
                                     </tr>
                         <?php  } ?>
                    </tbody>
                    <?php 
                        //Gestion des erreurs. 
                        if(isset($modifyAuteur))
                        {   
                            echo $modifyAuteur;
                        }
                        ?>
                </table>
        </article>
    </section>
</main>
<?php


ob_end_flush();
?>
