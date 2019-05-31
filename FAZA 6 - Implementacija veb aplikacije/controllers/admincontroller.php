<?php

/*
 * 
 * File: admincontroller.php
 * Author: Momcilo Savic 0586/2016
 * 
 */

class AdminController{
    
    public static $baloni;
    public static $termini;
    public static $termini2;
    public static $termini3;
    public static $zahtevi1;
    public static $zahtevi2;
    public static $korisnici;
    public static $ocena;
    
    public function __construct() {
        session_start();
        if(isset($_SESSION['username']) && isset($_SESSION['group'])){
            if(!strcmp($_SESSION['group'], 'V'))
                header("Location: ?controller=vip&action=index");
            elseif(!strcmp($_SESSION['group'], 'R'))
                header("Location: ?controller=admin&action=index");
        }
        else{
            header("Location: ?controller=gost&action=index");
        }
    }
    /**
     * Ucitavanje strane za prikaz admin panela
     * 
     * @return void
     */
    public function index() {
        require_once 'views/admin/header.php';
        require_once 'views/admin/index.php';
        require_once 'views/footer.php';
    }
    
    /**
     * Ucitavanje strane za prikaz termina za fudbal
     * 
     * @return void
     */
    public function fudbal() {
        require_once 'models/termin.php';
        require_once 'models/baloni.php';
        $_POST['sport'] = 'fudbal';
        self::$termini = Termin::dohvatiSveAktivneUKojimaNeUcestvujem($_SESSION['username'], 'fudbal');
        self::$baloni = Balon::dohvatiSve();
        require_once 'views/admin/header.php';
        require_once 'views/termini.php';
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
        self::$termini = Termin::dohvatiSveAktivneUKojimaNeUcestvujem($_SESSION['username'], 'kosarka');
        self::$baloni = Balon::dohvatiSve();
        require_once 'views/admin/header.php';
        require_once 'views/termini.php';
        require_once 'views/baloni.php';
        require_once 'views/footer.php';
    }
    
        /**
         * Pravljenje novog termina u bazi podataka
         * 
         * @return void
         */
        public function napravi(){
            if(!isset($_GET['sport']) || !isset($_GET['naslov']) || !isset($_GET['adresa']) || !isset($_GET['cena']) 
                    || !isset($_GET['datum']) || !isset($_GET['opis']) || !isset($_GET['broj_potrebnih_igraca']))
                header("Location: ?controller=admin&action=index");
            require_once 'models/termin.php';
            Termin::napravi($_GET['naslov'], $_GET['sport'], $_GET['adresa'], $_GET['datum'], $_GET['cena'], 
                    $_GET['broj_potrebnih_igraca'], $_GET['opis'], $_SESSION['username']);
            header("Location: ?controller=admin&action=termini");
        }

        /**
         * Ucitavanje strane za prikaz svih termina u kojima prijavljeni korisnik ucestvuje
         * 
         * @return void
         */
        public function termini(){
        require_once 'models/termin.php';
        require_once 'models/baloni.php';
        $_POST['sport'] = 'termini u kojima ucestvujes';
        self::$termini = Termin::dohvatiSveMojeAktivnePrihvacene($_SESSION['username']);
        self::$termini2 = Termin::dohvatiSveMojeNaCekanju($_SESSION['username']);
        self::$termini3 = Termin::dohvatiSveMojeAktivneKreirane($_SESSION['username']);
        self::$baloni = Balon::dohvatiSve();
        require_once 'views/admin/header.php';
        require_once 'views/mojitermini.php';
        require_once 'views/baloni.php';
        require_once 'views/footer.php';
    }
    
        /**
         * Prijavljivanje na aktivan termin (kreiranje zahteva)
         * 
         * @return void
         */
        public function prijavise(){
            if(!isset($_GET['termin']))
                header("Location: ?controller=admin&action=index");
            require_once 'models/zahtev.php';
            Zahtev::posalji($_SESSION['username'], $_GET['termin']);
            header("Location: ?controller=admin&action=termini");
            exit();
        }
        
        /**
         * Otkazivanje zahteva(na koji jos nije odgovoreno) za aktivan termin
         * 
         * @return void
         */
        public function otkazi(){
            if(!isset($_GET['termin']))
                header("Location = ?controller=admin&action=index");
            require_once 'models/zahtev.php';
            Zahtev::obrisi($_SESSION['username'], $_GET['termin']);
            header("Location: ?controller=admin&action=termini");
            exit();
        }
        
        /**
         * Otkazivanje zahteva(koji je prihvacen) za aktivan termin
         * 
         * @return void
         */
        public function otkazi_prihvacen(){
            if(!isset($_GET['termin']))
                header("Location = ?controller=admin&action=index");
            require_once 'models/zahtev.php';
            require_once 'models/termin.php';
            Zahtev::obrisi($_SESSION['username'], $_GET['termin']);
            Termin::umanjiBrojIgraca($_GET['termin']);
            header("Location: ?controller=admin&action=termini");
            exit();
        }
        
        /** 
         * Otkazivanje aktivnog termina(koji je prijavljeni korisnik napravio)
         * 
         * @return void
         */
        public function otkazi_kreiran(){
            if(!isset($_GET['termin']))
                header("Location = ?controller=admin&action=index");
            require_once 'models/zahtev.php';
            require_once 'models/termin.php';
            Zahtev::obrisiSve($_GET['termin']);
            Termin::obrisi($_GET['termin']);
            header("Location: ?controller=admin&action=termini");
            exit();
        }
    
    /**
     * Ucitavanje strane za prikaz obavestenja
     * 
     * @return void
     */
    public function obavestenja(){
        require_once 'models/zahtev.php';
        self::$zahtevi1 = Zahtev::dohvatiSveNaCekanjuZaMojTermin($_SESSION['username']);
        self::$zahtevi2 = Zahtev::dohvatiSveMojeOdgovorene($_SESSION['username']);
        require_once 'views/admin/header.php';
        require_once 'views/obavestenja.php';
        require_once 'views/footer.php';
    }
    
        /**
         * Prihvatanje zahteva za pristup terminu
         * 
         * @return void
         */
        public function prihvati(){
            if(!isset($_GET['korisnik']) || !isset($_GET['termin']))
                header("Location: ?controller=admin&action=index");
            require_once 'models/zahtev.php';
            require_once 'models/termin.php';
            Zahtev::prihvati($_GET['korisnik'], $_GET['termin']);
            Termin::uvecajBrojIgraca($_GET['termin']);
            header("Location: ?controller=admin&action=obavestenja");
            exit();
        }
        
        /**
         * Odbijanje zahteva za pristup terminu
         * 
         * @return void
         */
        public function odbij(){
            if(!isset($_GET['korisnik']) || !isset($_GET['termin']))
                header("Location: ?controller=admin&action=index");
            require_once 'models/zahtev.php';
            Zahtev::odbij($_GET['korisnik'], $_GET['termin']);
            header("Location: ?controller=admin&action=obavestenja");
            exit();
        }
        
    /**
     * Prikaz strane za ocenjivanje korisnika koji su ucestvovali na terminima sa prijavljenim korisnikom
     * 
     * @return void
     */
    public function oceni(){
        require_once 'models/termin.php';
        $_POST['sport'] = 'termini u kojima ucestvujes';
        self::$termini = Termin::dohvatiSveMojeNeaktivnePrihvaceneIKreirane($_SESSION['username']);
        if(isset($_GET['termin'])){
            require_once 'models/korisnik.php';
            self::$korisnici = Korisnik::dohvatiSveKojeNisamOcenio($_SESSION['username'], $_GET['termin']);
        }
        require_once 'views/admin/header.php';
        require_once 'views/ocene.php';
        require_once 'views/footer.php';
    }
    
        /**
         * Unos ocene u bazu podataka
         * 
         * @return void
         */
        public function potvrdi(){
            if(!isset($_GET['termin']) || !isset($_GET['korisnik']) || !isset($_GET['ocena']) || !isset($_GET['razlog']))
                header("Location: ?controller=admin&action=index");
            require_once 'models/ocena.php';
            require_once 'models/korisnik.php';
            require_once 'models/termin.php';
            Ocena::unesi($_GET['termin'], $_GET['korisnik'], $_SESSION['username'], $_GET['ocena'], $_GET['razlog']);
            Korisnik::uvecajOcenu($_GET['korisnik'], $_GET['ocena']);
            Termin::azurirajOcenu($_GET['korisnik']);
            unset($_GET['korisnik']);
            unset($_GET['ocena']);
            unset($_GET['razlog']);
            header("Location: ?controller=admin&action=oceni&termin=" . $_GET['termin']);
        }
    
    /**
     * Odjavljivanje sa sistema
     * 
     * @return void
     */
    public function logout(){
        session_destroy();
        header("Location: ?controller=gost&action=index");
    }
    
    /**
     * Prikaz stranice sa sadrzajem pravilnika
     * 
     * @return void
     */
    public function pravilnik(){
        require_once 'models/baloni.php';
        self::$baloni = Balon::dohvatiSve();
        require_once 'views/admin/header.php';
        require_once 'views/pravilnik.php';
        require_once 'views/baloni.php';
        require_once 'views/footer.php';
    }
    
    /**
     * Dohvatanje ocene prijavljenog korisnika
     * 
     * @return float/string 
     */
    public static function dohvatiOcenu(){
    require_once 'models/ocena.php';
    return Ocena::dohvati($_SESSION['username']);
    }
    
    public function reklame() {
        require_once 'views/admin/header.php';
        require_once 'views/reklame.php';
        require_once 'views/footer.php'; 
    }
    
    
    
    
    
    
    
    
    
    
    /**
     * Prikaz strane sa listom svih korisnika
     * 
     * @return void
     */
    public function upravljaj_korisnicima() {
        require_once 'models/korisnik.php';
        self::$korisnici = Korisnik::dohvatiSve();
        require_once 'views/admin/header.php';
        require_once 'views/admin/korisnici.php';
        require_once 'views/footer.php';
    }
    
        /**
         * Banovanje korisnika
         * 
         * @return void
         */
        public static function banuj(){
            if(!isset($_GET['korisnik']))
                header("Location: ?controller=admin&action=index");
            require_once 'models/korisnik.php';
            require_once 'models/termin.php';
            Korisnik::banuj($_GET['korisnik']);
            Termin::obrisiSveMojeAktivne($_GET['korisnik']);
            header("Location: ?controller=admin&action=upravljaj_korisnicima");
        }
        
        /**
         * Ukidanje bana korisniku
         * 
         * @return void
         */
        public static function odbanuj(){
            if(!isset($_GET['korisnik']))
                header("Location: ?controller=admin&action=index");
            require_once 'models/korisnik.php';
            Korisnik::odbanuj($_GET['korisnik']);
            header("Location: ?controller=admin&action=upravljaj_korisnicima");
        }
        
        /**
         * Unapredjivanje korisnika u VIP
         * 
         * @return void
         */
        public static function unapredi(){
            if(!isset($_GET['korisnik']))
                header("Location: ?controller=admin&action=index");
            require_once 'models/korisnik.php';
            Korisnik::unapredi($_GET['korisnik']);
            header("Location: ?controller=admin&action=upravljaj_korisnicima");
        }
        
        /**
         * Smanjivanje ranka korisnika sa VIP na REGISTROVANI KORISNIK
         * 
         * @return void
         */
        public static function degradiraj(){
            if(!isset($_GET['korisnik']))
                header("Location: ?controller=admin&action=index");
            require_once 'models/korisnik.php';
            Korisnik::degradiraj($_GET['korisnik']);
            header("Location: ?controller=admin&action=upravljaj_korisnicima");
        }
    
     /**
      * Ucitavanje strane sa listom svih termina
      * 
      * @return void
      */
    public function upravljaj_terminima() {
        require_once 'models/termin.php';
        self::$termini = Termin::dohvatiSve();
        require_once 'views/admin/header.php';
        require_once 'views/admin/termini.php';
        require_once 'views/footer.php';
    }
        
    /**
     * Brisanje termina iz baze podataka
     * 
     * @retun void
     */
        public function obrisi_termin(){
            if(!isset($_GET['termin']))
                header("Location = ?controller=admin&action=index");
            require_once 'models/zahtev.php';
            require_once 'models/termin.php';
            Zahtev::obrisiSve($_GET['termin']);
            Termin::obrisi($_GET['termin']);
            header("Location: ?controller=admin&action=upravljaj_terminima");
            exit();
        }
        
        /**
         * Prikaz prozora sa listom svih ocena izabranog korisnika
         * 
         * @return void
         */
        public static function dohvatiSveOcene(){
            if(!isset($_GET['korisnik']))
                header("Location = ?controller=admin&action=index");
            require_once 'models/ocena.php';
            self::$ocena = Ocena::dohvatiSve($_GET['korisnik']);
        }
    
        /**
         * Funkcija za dohvatanje svih korisnika
         * 
         * @return void
         */
        public static function dohvatiSveKorisnike(){
            require_once 'models/korisnik.php';
            self::$korisnici = Korisnik::dohvatiSve();
        }
        
        /**
         * Funkcija za dohvatanje svih termina
         * 
         * @return void
         */
        public static function dohvatiSveTermine(){
            require_once 'models/termin.php';
            self::$termini = Termin::dohvatiSve();
        }
        
    /**
     * Ucitavanje strane za prikaz Admin panela za upravljanje reklamama
     * 
     * @return void
     */
    public function upravljaj_reklamama() {
        require_once 'models/baloni.php';
        self::$baloni = Balon::dohvatiSve();
        require_once 'views/admin/header.php';
        require_once 'views/admin/reklame.php';
        require_once 'views/footer.php';
    }
    
    /**
     * Brisanje reklame iz baze podataka
     * 
     * @return void
     */
        public function obrisi_reklamu(){
            if(!isset($_GET['reklama']))
                header("Location = ?controller=admin&action=index");
            require_once 'models/baloni.php';
            Balon::obrisi($_GET['reklama']);
            header("Location: ?controller=admin&action=upravljaj_reklamama");
            exit();
        }
};

?>