<?php
require_once('Bddconnexion.php');

// etendre cette classe aux classes enfants
abstract class Model extends Bddconnexion
{
    protected $bdd;

    public function __construct()
    {
        
        $this->bdd = $this->connect();
    }
    
}