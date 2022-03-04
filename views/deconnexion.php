<?php 
    
// Destruction de la session
        
session_destroy();
    
// Redirection vers la page de connexion

header('location: index.php');

?>