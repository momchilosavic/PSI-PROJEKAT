<?php

/*
 * 
 * File: gostcontroller.php
 * Author: Momcilo Savic 0586/2016
 * 
 */

/**
 * GostController - klasa za upravljanje akcijama gosta veb stranice
 * 
 * @version 1.0
 */
class GostController{
    
    /*
     * @var Termin $termini - Lista termina nakon izvrsavanja upita u bazi
     */
    public static $termini = null;
    /*
     * @var Balon $baloni - Lista balona nakon izvrsavanja upita u bazi
     */
    public static $baloni = null;
    
    /**
     * Kreiranje nove instance
     * 
     * @return void
     */
    public function __construct() {
        session_start();
        if(isset($_SESSION['username']) && isset($_SESSION['group'])){
            if(!strcmp($_SESSION['group'], 'R'))
                header("Location: ?controller=korisnik&action=index");
            elseif(!strcmp($_SESSION['group'], 'V'))
                header("Location: ?controller=vip&action=index");
            elseif(!strcmp($_SESSION['group'], 'A'))
                header("Location: ?controller=admin&action=index");
        }
    }
    /**
     * Ucitavanje pocetne strane
     * 
     * @return void
     */
    public function index() {
        require_once 'models/baloni.php';
        self::$baloni = Balon::dohvatiSve();
        require_once 'views/gost/header.php';
        require_once 'views/gost/index.php';
        require_once 'views/baloni.php';
        require_once 'views/footer.php';
    }

    /*
     * Ucitavanje strane za prikaz termina za fudbal
     * 
     * @return void
     */
    public function fudbal() {
        require_once 'models/termin.php';
        require_once 'models/baloni.php';
        $_POST['sport'] = 'fudbal';
        $termin = new Termin();
        self::$termini = $termin->dohvatiSveAktivne('fudbal');
        self::$baloni = Balon::dohvatiSve();
        require_once 'views/gost/header.php';
        require_once 'views/gost/termini.php';
        require_once 'views/baloni.php';
        require_once 'views/footer.php';
    }
    
    /**
     * Ucitavanje strane za prikaz termina za kosarku
     * 
     * @return void
     */
    public function kosarka() {
        require_once 'models/termin.php';
        require_once 'models/baloni.php';
        $_POST['sport'] = 'kosarka';
        $termin = new Termin();
        self::$termini = $termin->dohvatiSveAktivne('kosarka');
        self::$baloni = Balon::dohvatiSve();
        require_once 'views/gost/header.php';
        require_once 'views/gost/termini.php';
        require_once 'views/baloni.php';
        require_once 'views/footer.php';
    }
    
    /**
     * Ucitavanje strane za prijavljivanje na sistem
     * 
     * @return void
     */
    public function login_register(){
        require_once 'views/gost/header.php';
        require_once 'views/gost/login_register.php';
        require_once 'views/footer.php';
    }
    
        /**
         * Provera da li korisnik moze da se prijavi na sistem, i prijavljuje ga ako moze
         * 
         * @return void
         */
        public function login() {
            if(empty($_POST['username'])){
                $poruka = "Sva polja moraju biti popunjena!";
            }
            else if(empty($_POST['password'])){
                $_POST['name'] = $_POST['username'];
                $poruka = "Sva polja moraju biti popunjena!";
            }
            else{
                $_POST['name'] = $_POST['username'];
                require_once 'models/korisnik.php';
                $result = Korisnik::dohvati($_POST['username']);
                if($result == NULL)
                    $poruka = "Neispravno korisnicko ime/lozinka!";
                else{
                    if(password_verify($_POST['password'], $result->password)){
                        Korisnik::azurirajVremePrijave($_POST['username']);
                    }
                    else{
                        $poruka = "Neispravno korisnicko ime/lozinka!";
                    }
                }
            }
            if(!isset($poruka)){
                $now = new DateTime();
                $_SESSION['username'] = $result->username; 
                $_SESSION['log_time'] = $now->format("Y-m-d H:i:s");
                $_SESSION['group'] = $result->grupa;

                switch($result->grupa){
                    case 'R': {
                        header("Location: ?controller=korisnik&action=index");
                        break;
                    }
                    case 'V': {
                        header("Location: ?controller=vip&action=index");
                        break;
                    }
                    case 'A': {
                        header("Location: ?controller=admin&action=index");
                        break;
                    }
                    case 'B': {
                        $_POST['poruka'] = "Vas nalog je banovan!";
                        session_destroy();
                        $this->login_register();
                        exit();
                    }
                }

            }
            else{
                $_POST['poruka'] = $poruka;
                $this->login_register();
                exit();
            }
        }

        /**
         * Provera da li korisnik moze da se registruje u sistemu, i registruje ga ako moze
         * 
         * @return void
         */
        public function register(){
            if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['password_validation']) ||
                    empty($_POST['email']))
                $poruka0 = "Sva polja moraju biti popunjena!";
            else{
                if(strlen($_POST['password']) < 8){
                    $poruka2 = "Lozinka mora sadrzati najmanje 8 karaktera!";
                }
                else{
                    if(strcmp($_POST['password'], $_POST['password_validation']))
                        $poruka3 = "Lozinke se ne poklapaju!";
                }
                if(count(explode('@', $_POST['email'])) != 2 || strlen(explode('@', $_POST['email'])[1]) == 0){
                        $poruka4 = "Neispravna e-adresa!";
                }
            }
            if(!isset($poruka0) && !isset($poruka1) && !isset($poruka2) && !isset($poruka3) && !isset($poruka4)){
                require_once 'models/korisnik.php';
                if(Korisnik::dodaj($_POST['username'], $_POST['password'], $_POST['email'])){
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['group'] = 'R';
                    $_SESSION['log_time'] = (new DateTime())->format("Y-m-d H:i:s");
                    header("Location: ?controller=korisnik&action=index");
                    exit();
                }
                else{
                    $poruka1 = "Korisnicko ime je zauzeto!";
                    $_POST['poruka1'] = $poruka1;
                    $this->login_register();
                    exit();
                }
            }
            else{
                if(isset($poruka0))
                    $_POST['poruka0'] = $poruka0;
                if(isset($poruka2))
                    $_POST['poruka2'] = $poruka2;
                if(isset($poruka3))
                    $_POST['poruka3'] = $poruka3;
                if(isset($poruka4))
                    $_POST['poruka4'] = $poruka4;
                $this->login_register();
                exit();
            }
        }
    
    /**
     * Ucitavanje strane gde se prikazuje pravilnik
     * 
     * @return void
     */
    public function pravilnik() {
        require_once 'models/baloni.php';
        require_once 'views/gost/header.php';
        require_once 'views/pravilnik.php';
        self::$baloni = Balon::dohvatiSve();
        require_once 'views/baloni.php';
        require_once 'views/footer.php';
    }
    
    /**
     * Ucitavanje strane ukoliko korisnik zeli da pristupi nepostojecoj strani
     * 
     * @return void
     */
    public function greska(){
        require_once 'models/baloni.php';
        self::$baloni = Balon::dohvatiSve();
        require_once 'views/gost/header.php';
        require_once 'views/gost/greska.php';
        require_once 'views/baloni.php';
        require_once 'views/footer.php';
    }
    
};

?>