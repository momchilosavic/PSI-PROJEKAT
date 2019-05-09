<?php

/*
 * 
 * File: connection.php
 * Author: Momcilo Savic
 * 
 */

define("HOST", "localhost");
define("MYSQL_DATABASE", "trebamiigrac");
define("MYSQL_USERNAME", "root");
define("MYSQL_PASSWORD", "");

class Connection{
    private function __construct() {}
    private function __clone() {}
    
    private static $instance;
    
    public static function getInstance(){
        if(!isset(self::$instance)){
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            
            self::$instance = new PDO("mysql:host=" . HOST . ";dbname=" . MYSQL_DATABASE, MYSQL_USERNAME, MYSQL_PASSWORD,
                    $pdo_options);
        }
        
        return self::$instance;
    }
};

?>