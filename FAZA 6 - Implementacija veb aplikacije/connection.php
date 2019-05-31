<?php

/*
 * 
 * File: connection.php
 * Author: Momcilo Savic 0586/2016
 * 
 */

/***
* LOCAL HOST PODACI
***/
define("HOST", "localhost");
define("MYSQL_DATABASE", "trebamiigrac");
define("MYSQL_USERNAME", "root");
define("MYSQL_PASSWORD", "");

/***
* AZURE PODACI
***/
/*
define("HOST", "psi-projekat-server.mysql.database.azure.com");
define("MYSQL_DATABASE", "trebamiigrac");
define("MYSQL_USERNAME", "momchilo@psi-projekat-server");
define("MYSQL_PASSWORD", "Momcilo97");*/

/**
 *  Connection - Klasa za uspostavljanje konekcije sa serverom i povezivanje na bazu podataka
 * 
 */
class Connection{
    private function __construct() {}
    private function __clone() {}
    
    /**
     *
     * @var Connection Instanca konekcije
     */
    private static $instance;
    
    /**
     * Funkcija koja vraca instancu konekcije ako postoji ili kreira novu ako ne postoji
     * 
     * @return Connection
     */
    public static function getInstance(){
        if(!isset(self::$instance)){
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            
            self::$instance = new PDO("mysql:host=" . HOST . ";dbname=" . MYSQL_DATABASE, MYSQL_USERNAME, MYSQL_PASSWORD,
                    $pdo_options);
        }
        
        return self::$instance;
    }
}