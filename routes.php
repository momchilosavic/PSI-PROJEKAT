<?php

/*
 * 
 * File: routes.php
 * Author: Momcilo Savic
 * 
 */

function call($controller, $action){
    require_once 'controllers/' . $controller . 'controller.php';
    switch($controller){
        case 'gost':
            $controller = new GostController();
            break;
        case 'korisnik':
            $controller = new KorisnikController();
            break;
        case 'vip':
            $controller = new VIPController();
            break;
        case 'admin':
            $controller = new AdminController();
            break;
    }
    
    $controller->$action();
}

$controllers = array('gost' => ['index', 'fudbal', 'kosarka', 'login', 'pravilnik', 'register', 'login_register'],
                     'korisnik' => ['index','fudbal', 'kosarka', 'pravilnik', 
                                    'termini', 'prijavise', 'otkazi', 'otkazi_prihvacen', 'otkazi_kreiran', 'napravi',
                                    'obavestenja', 'prihvati', 'odbij',
                                    'oceni', 'ucesnici', 'potvrdi',
                                    'logout'],
                     'vip' => ['index'],
                     'admin' => ['index']);

if(array_key_exists($controller, $controllers)){
    if(in_array($action, $controllers[$controller])){
        call($controller, $action);
    }
    else{
        call('gost', 'greska');
    }
}
else{
    call('gost', 'greska');
}

?>