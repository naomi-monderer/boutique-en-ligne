<?php
session_start();
require_once("../models/ArticleModel.php");
$bdd = new ArticleModel();

// je stock les donner du formulaire adresse de livraison
$adresse = htmlspecialchars(trim($_POST["adresse"]));
$codepostal = htmlspecialchars(trim($_POST["codepostal"]));
$pays = htmlspecialchars(trim($_POST["pays"]));
$ville = htmlspecialchars(trim($_POST["ville"]));
$name = htmlspecialchars(trim($_POST["name"]));
$carte = htmlspecialchars(trim($_POST["carte"]));
$cvc = htmlspecialchars(trim($_POST["cvc"]));
$expiration = htmlspecialchars(trim($_POST["expiration"]));
$expirationyear = htmlspecialchars(trim($_POST["expiration_year"]));
// je verifie si les champs du formulaire sont pas vide


if(!empty($name)&& !empty($carte)&& !empty($cvc)&& !empty($expiration)&& !empty($expirationyear) && !empty($adresse)&& !empty($codepostal)&&!empty($pays)&& !empty($ville)){

     // on verifie que le code postal ces bien un chiffre
     if(strlen($codepostal)==5){
        // On verifie le nombre de chiffre de la carte il en 16
        if(strlen($carte) == 16){
            if(strlen($cvc) == 3 ){
                if(strlen($expiration) == 2 && intval($expiration) >= 01 && intval($expiration) <=12){
                    if(strlen($expirationyear) == 2){
                        $date =date("y");
                        if ($expirationyear >= $date){
                            //Creation du numero de commande == dade du jour + numero aleatoir
                            $date = date("mY");
                            $numero_commande = $date.rand();
                       

                            // Insertion de la commande et de son detail
                            require_once('../models/PayementModel.php');
                            $paiement = new payementModel();

                            // enregistrement de la commande
                            $paiement->createCommande(intval($numero_commande),intval($_SESSION['total']),intval($_SESSION['user'][0]['id']));

                            // Enregistrement du detail de la commende
                            foreach($_SESSION['produits'] as $produit){
                                $paiement->createDetailCommande($produit['id'],$produit['quantite'],$numero_commande);
                            }
                            // message succes
                            require_once('../models/PanierModel.php');
                            $panier = new PanierModel();
                            $panier->delete($_SESSION['user'][0]['id']);
                            unset($_SESSION['produits']);

                            // enregistrement de l'adresse de livraison
                            $paiement->addAddress($_SESSION['user'][0]['id'],$adresse,$codepostal,$ville,$pays);

                            // Redirection vers profil
                            header('location: ../views/profil.php');
                       

                   }else{
                        $_SESSION["erreur"]="L'année d'experation est incorrect.";
                        header('Location: ../views/payement.php');
                   }

                }else{
                    $_SESSION["erreur"]="L'année d'experation est incorrect.";
                    header('Location: ../views/payement.php');
                }
                
            }else{
                $_SESSION["erreur"]="Le numéro d'experation est incorrect.";
                header('Location: ../views/payement.php');
            }

        }else{
            $_SESSION["erreur"]="Le numéro de CVC est incorrect.";
            header('Location: ../views/payement.php');
        }

    

    }else{
        $_SESSION["erreur"]="Le numéro de carte ne correspons pas a votre pays d'origine.";
        header('Location: ../views/payement.php');

    }

    }else{
        $_SESSION["erreur"]="le code postal n'est pas correct";
        header('Location: ../views/payement.php');
    }


    

}else{
    $_SESSION["erreur"]="Tout les champs doivent etre remplis pour le paiement";
    header('Location: ../views/payement.php');
}





?>