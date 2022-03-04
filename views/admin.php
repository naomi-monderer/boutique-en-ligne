<?php
require_once('../controllers/AdminController.php');
require_once('include/header.php');
?>
<main>
    <section>
        <h1>Espace Administratif</h1>
            <article>
                    <div>
                        <h2>Gestion des utilisateurs</h2>
                        <form action="">
                            <button type="button">Afficher les utilisateur</button>
                        </form>

                    </div>
                    <div>
                        <h2>Gestion des produits</h2>
                        <button type="button">Afficher les produits</button>
                       
                    </div>    
            </article>
            <article>
                <h2>Enregistrer un nouvel ouvrage</h2>
                    <form action="" method="POST">
                        
                        <label for="Nom de l'ouvrage">
                            <input type="text" name="nom" value="" placeholder="">

                            <label for="Description">
                                <input textarea name="description" value="" placeholder="">

                            <label for="Stock">
                                <input type="number" name="stock" value="" placeholder="">

                                <label for="Prix">
                                    <input type="text" name="" value="" placeholder="">€
                                
                                <label for="Mise en avant">
                                    <select name="">
                                    <option value="choose" name="" value="" placeholder="">
                                    </select>
                                    
                                <label for="Editeur">
                                    <input type="text" name="" value="" placeholder="">
     
                                <label for="La catégorie par genre">
                                    <input type="text" name="" value="" placeholder="">

                                <label for="Sous-catégorie par type">
                                    <input type="text" name="" value="" placeholder="">

                                <h2>Auteur</h2>
                                <label for="Nom">
                                    <input type="text" name="" value="" placeholder="">

                                <label for="Prénom">
                                    <input type="text" name="" value="" placeholder="">             
                </form>
        </article>
    </section>
</main>