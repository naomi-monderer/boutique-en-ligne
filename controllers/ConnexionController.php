<?php
require("../models/UserModel.php");
// $bdd = new BddConnexion("localhost","boutique","root","");
// $pdo= $bdd->connexion();
// $utilisateur = new Utilisateur($pdo);
// $login = security($_POST["login"]);

class User
{
    public function connexion()
    {
        if(!empty($login)&& !empty($password))
        {
            $utilisateur = new UserModel;
            // je verifie que le login existe en bdd
            $cheklogin  = $utilisateur->checkLogin($login);
            if($cheklogin == 1)
            {
            
                

           
            }
        }else
        {

            echo  "tout les champs doivent etre remplis";
            header("location../connexion.php");
        }



    }
}


?>