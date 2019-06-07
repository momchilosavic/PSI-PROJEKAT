<?php

/*
 * 
 * File: vipcontroller.php
 * Author: Momcilo Savic 586/16
 * Author: Branislav Bajić 0599/2016
 * 
 */

class VIPController{
    
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
            if (!strcmp($_SESSION['group'], 'R')) {
                header("Location: ?controller=vip&action=index");
            } elseif (!strcmp($_SESSION['group'], 'A')) {
                header("Location: ?controller=admin&action=index");
            }
        }
        else{
            header("Location: ?controller=gost&action=index");
        }
    }
    
    public function index() {
        require_once 'models/baloni.php';
        self::$baloni = Balon::dohvatiSve();
        require_once 'views/vip/header.php';
        require_once 'views/vip/index.php';
        require_once 'views/baloni.php';
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
        require_once 'views/vip/header.php';
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
        require_once 'views/vip/header.php';
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
                header("Location: ?controller=vip&action=index");
            require_once 'models/termin.php';
            Termin::napravi($_GET['naslov'], $_GET['sport'], $_GET['adresa'], $_GET['datum'], $_GET['cena'], 
                    $_GET['broj_potrebnih_igraca'], $_GET['opis'], $_SESSION['username']);
            header("Location: ?controller=vip&action=termini");
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
        require_once 'views/vip/header.php';
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
                header("Location: ?controller=vip&action=index");
            require_once 'models/zahtev.php';
            Zahtev::posalji($_SESSION['username'], $_GET['termin']);
            header("Location: ?controller=vip&action=termini");
            exit();
        }
        
        /**
         * Otkazivanje zahteva(na koji jos nije odgovoreno) za aktivan termin
         * 
         * @return void
         */
        public function otkazi(){
            if(!isset($_GET['termin']))
                header("Location = ?controller=vip&action=index");
            require_once 'models/zahtev.php';
            Zahtev::obrisi($_SESSION['username'], $_GET['termin']);
            header("Location: ?controller=vip&action=termini");
            exit();
        }
        
        /**
         * Otkazivanje zahteva(koji je prihvacen) za aktivan termin
         * 
         * @return void
         */
        public function otkazi_prihvacen(){
            if(!isset($_GET['termin']))
                header("Location = ?controller=vip&action=index");
            require_once 'models/zahtev.php';
            require_once 'models/termin.php';
            Zahtev::obrisi($_SESSION['username'], $_GET['termin']);
            Termin::umanjiBrojIgraca($_GET['termin']);
            header("Location: ?controller=vip&action=termini");
            exit();
        }
        
        /** 
         * Otkazivanje aktivnog termina(koji je prijavljeni korisnik napravio)
         * 
         * @return void
         */
        public function otkazi_kreiran(){
            if(!isset($_GET['termin']))
                header("Location = ?controller=vip&action=index");
            require_once 'models/zahtev.php';
            require_once 'models/termin.php';
            Zahtev::obrisiSve($_GET['termin']);
            Termin::obrisi($_GET['termin']);
            header("Location: ?controller=vip&action=termini");
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
        require_once 'views/vip/header.php';
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
                header("Location: ?controller=vip&action=index");
            require_once 'models/zahtev.php';
            require_once 'models/termin.php';
            Zahtev::prihvati($_GET['korisnik'], $_GET['termin']);
            Termin::uvecajBrojIgraca($_GET['termin']);
            header("Location: ?controller=vip&action=obavestenja");
            exit();
        }
        
        /**
         * Odbijanje zahteva za pristup terminu
         * 
         * @return void
         */
        public function odbij(){
            if(!isset($_GET['korisnik']) || !isset($_GET['termin']))
                header("Location: ?controller=vip&action=index");
            require_once 'models/zahtev.php';
            Zahtev::odbij($_GET['korisnik'], $_GET['termin']);
            header("Location: ?controller=vip&action=obavestenja");
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
        require_once 'views/vip/header.php';
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
                header("Location: ?controller=vip&action=index");
            require_once 'models/ocena.php';
            require_once 'models/korisnik.php';
            require_once 'models/termin.php';
            Ocena::unesi($_GET['termin'], $_GET['korisnik'], $_SESSION['username'], $_GET['ocena'], $_GET['razlog']);
            Korisnik::uvecajOcenu($_GET['korisnik'], $_GET['ocena']);
            Termin::azurirajOcenu($_GET['korisnik']);
            unset($_GET['korisnik']);
            unset($_GET['ocena']);
            unset($_GET['razlog']);
            header("Location: ?controller=vip&action=oceni&termin=" . $_GET['termin']);
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
        require_once 'views/vip/header.php';
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
    
	public function dodaj_reklamu() {
		
		$poruka = '';
		if(isset($_POST['submit'])){
			if(empty($_POST['reklame_naziv']) || empty($_POST['reklame_adresa']) || empty($_POST['reklame_url'])) {
				$poruka = 'Sva polja moraju biti popunjena!';
			}
			else {
				$name = $_FILES['reklame_slika']['name'];
				$tmp_name = $_FILES['reklame_slika']['tmp_name'];
				
				if(isset($name)) {
					if(!empty($name)) {
						
						
						$file_type = strtolower(pathinfo($name,PATHINFO_EXTENSION));
						$file_size = $_FILES['reklame_slika']["size"];
						
						if(file_exists($name)) {
							$poruka = "Slika već postoji!";
						}
						else if($file_type != 'jpg' && $file_type != 'jpeg' && $file_type != 'png') {
							$poruka = "Nedozvoljen format slike! (Samo .jpg, .jpeg, .png)";
						}
						else if($file_size > 1048576) {
							$poruka = "Slika prelazi dozvoljenu veličinu!(1MB)";
						}
						else if($file_size == 0){
							$poruka = "Morate izabrati sliku!";
						}
						else {
							$location = realpath(dirname(getcwd())).'/TrebaMiIgrac/views/reklame/';
							if(move_uploaded_file($tmp_name, $location.$name)) {
								$poruka = 'Reklama je uspešno dodata.';
								require_once 'models/baloni.php';
								Balon::dodaj($_POST['reklame_naziv'], $_POST['reklame_adresa'], $_POST['reklame_url'], $name, $_SESSION['username']);
								//$poruka = $_POST['reklame_naziv'].'-'.$_POST['reklame_adresa'].'-'.$_POST['reklame_url'].'-'.$name.'-'.$_SESSION['username'];
								header("Location: ?controller=vip&action=reklame");
							}
							else {
								$poruka = 'Desio se problem u dodavanju slike!';
							}
						}
					}
				}
			}
		}
		$_POST['poruka'] = $poruka;
		$this->reklame();
	}
	
    public function reklame() {
		
		require_once 'models/baloni.php';
		if(count(self::$baloni = Balon::dohvati($_SESSION['username'])) <= 0) {
			require_once 'views/vip/header.php';
			require_once 'views/reklame.php';
			require_once 'views/footer.php'; 
		}
		else {
			require_once 'views/vip/header.php';
			require_once 'views/moje_reklame.php';
			require_once 'views/footer.php'; 
		}
    }
    
    
    
    
    
    
    
    
    
    
    
}