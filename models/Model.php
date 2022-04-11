<?php
require_once('Bddconnexion.php');

// etendre cette classe aux classes enfants
abstract class Model extends Bddconnexion
{   
    protected $table;
    protected $bdd;

    public function __construct()
    {
        
        $this->bdd = $this->connect();
    }
    
    public function getOneValue($table,$column,$value)
    {   
       
        $requete = "SELECT * FROM $table WHERE $column = ?";
        $result = $this->connect()->prepare($requete);
        $result->execute(array($value));
        $checkValue = $result->fetchAll(PDO :: FETCH_ASSOC);
        
        //var_dump($checkUser);
        
        return $checkValue;
    }
    public function selectAllWhere($target,$table,$column,$value)
    {
        $requette = $this->connect()->prepare("SELECT $target FROM $table WHERE $column = ?");
        $requette->execute(array($value));
        $resultat = $requette->fetchAll(PDO :: FETCH_ASSOC);
        // var_dump($resultat);
        return $resultat;

    }

   
}