<?php

/*
 * 
 * File: index.php
 * Author: Momcilo Savic 0586/2016
 * 
 */

require_once 'connection.php';

if(isset($_GET['controller']) && isset($_GET['action'])){
    $controller = $_GET['controller'];
    $action = $_GET['action'];
}
else{
    $controller = 'gost';
    $action = 'index';
}

require_once 'routes.php';
