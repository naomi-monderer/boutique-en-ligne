<?php
require_once('../models/UserModel.php');
require('../models/ArticleModel.php');

class AdminController 
{

    public function __construct()
    {
        $this->model = new UserModel;
        
    }

    public function showAllUsers()
    {   
        $AllUsers = $this->model->findAllUsers();
        var_dump($AllUsers);
        
    }
 // je veux afficher tout mes utilisateurs dans un tableau
 // je dois attraper l'id dans le fetch de ma fonction findUser
 //je dois appeler ma fonction 
    
}
?>