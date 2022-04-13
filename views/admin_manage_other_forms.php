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
<main class="main-bo">
    <?php require_once('include/sideBar.php')?>
    <div class="contener">
      <section class="contener-rest-options">
    <section class="child-contener-rest">
        <article class="contener-titre-principal">
            <h2>Gestion des Categories</h2>
        </article>
        <article>
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
                            foreach($allCategories as $category){

                        ?>        
                           <tr>
                               <form action="" method="post">
                                    <td>
                                        <p><?= $category['id']?></p>
                                    </td>
                                    <td>
                                        <input class="input-large" type="text" name="nom_cat" value="<?= $category['nom_categorie']?>">
                                    </td>
                                    <td class="butt-manage-modif">
                                    <button class="butt-modif" type="submit" name="modify_categorie" ><i class="fa-solid fa-screwdriver-wrench"></i></button>
                                    <input class="input-large" type="hidden" name="idHidden_categorie" value="<?=$category['id'];?>" > 
                                    </td>
                                </form>
                                <form action="" method="post">
                                    <td class="butt-manage-supp"> 
                                    <button class="butt-delete" name="delete_categorie" type='submit'><i class="fa-solid fa-xmark"></i></button>  
                                    <input  type="hidden" name="idHidden_categorie" value="<?=$category['id'];?>" > 
                                        
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
        </section>

       <section class="child-contener-rest">
           <article class="contener-titre-principal"> 
                <h2>Gestion des Sous-Categories</h2>
            </article>
            <article>   
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
                                                <input class="input-large" type="text" name="sous-cat" value="<?= $list['nom_souscategorie'];?>">
                                            </td>    
                                        
                                            <td class="butt-manage-modif">
                                                
                                                <button class="butt-modif" type="submit" name="modify_souscategorie" ><i class="fa-solid fa-screwdriver-wrench"></i></button>

                                                <input type="hidden" name="idHidden_souscategorie" value="<?=$list['id'];?>" > 
                                                <input type="hidden" name="idHidden_cat" value="<?=$list['id_categorie'];?>" > 
                                            </td>
                                        </form>
                                        <form action="" method="post">
                                            <td class="butt-manage-supp">
                                            <button class="butt-delete" name="delete_souscategorie" type='submit'><i class="fa-solid fa-xmark"></i></button>  
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
           </article>
        </section>

        <section class="child-contener-rest">
            <article class="contener-titre-principal">
                <h2> Gestion des Auteur.ices</h2>
            </article>
            <article>
                <table>
                    <thead>
                        <th>ID</th>
                        <th>NOM</th>
                        <th>PRENOM</th>
                        <th>MODIFIER</th>
                        <th>SUPPRIMER</th>
                    </thead>
                    <tbody>
                        <?php foreach($listAuteurs as $listAuteur)
                                { ?>
                                    <tr>
                                        <form class="form-bo" action="admin_manage_other_forms.php" method="post">
                                            <td>
                                                <p><?= $listAuteur['id']?></p>
                                            </td>
                                            <td>
                                                <input class="input-large" type="text" name="nom_auteur" value="<?= $listAuteur['nom']?>">
                                            </td>
                                            <td>
                                            <input class="input-large" type="text" name="prenom_auteur" value="<?= $listAuteur['prenom']?>">
                                            </td>
                                            <td class="butt-manage-supp">
                                               
                                                <button class="butt-modif" type="submit" name="modify_auteur" ><i class="fa-solid fa-screwdriver-wrench"></i></button>

                                                <input class="input-large" type="hidden" name="idHidden_auteur" value="<?=$listAuteur['id'];?>" > 
                                            </td>
                                        </form>
                                        <form action="" method="post">
                                            <td class="butt-manage-supp">
                                            <button class="butt-delete" name="delete_auteur" type='submit'><i class="fa-solid fa-xmark"></i></button>  
                                                
                                                <input  type="hidden" name="idHidden_auteur" value="<?=$listAuteur['id'];?>" > 
                                                
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
        </section>
        </div>
</main>
<?php
require_once('include/footer.php');
ob_end_flush();
?>
