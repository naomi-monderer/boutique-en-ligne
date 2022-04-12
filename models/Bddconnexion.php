<?php

 abstract  class Bddconnexion{

    private $host = 'localhost';
    private $nom = 'boutique';
    private $user = 'root';
    private $pass = '';
    protected $pdo;


    public function connect()
    {
        $this->pdo = new PDO('mysql:host='.$this->host.';dbname='.$this->nom, $this->user,$this->pass);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec("SET CHARACTER SET utf8");
        return $this->pdo;
    }
    

}