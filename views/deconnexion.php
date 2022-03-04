<?php 

session_session();
// Destruction de la session
        
session_destroy();
    
// Redirection vers la page de connexion

header('location: boutique-en-ligne/views/index.php');

?>