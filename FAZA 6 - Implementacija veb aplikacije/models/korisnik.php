<?php

/*
 * 
 * File: korisnik.php
 * Author: Momcilo Savic 0586/2016
 * 
 */

/**
 * Korisnik - Klasa za rad sa tabelom Korisnik u baze podataka
 * 
 */
class Korisnik{
    /**
     *
     * @var string Korisnicko ime
     */
    public $username;
    /**
     *
     * @var string Lozinka
     */
    public $password;
    /**
     *
     * @var string
     */
    public $email;
    /**
     *
     * @var char Rank korisnika
     */
    public $grupa;
    /**
     *
     * @var int Zbir svih ocena
     */
    public $zbir_ocena;
    /**
     *
     * @var int Broj svih ocena
     */
    public $broj_ocena;
    /**
     *
     * @var DateTime
     */
    public $datum_registracije;
    /**
     *
     * @var DateTime
     */
    public $datum_poslednje_prijave;

    /**
     * Funkcija vraca sve korisnike iz baze podataka
     * 
     * @return Korisnik
     */
    public static function dohvatiSve(){
        $sql = "SELECT * FROM korisnik WHERE grupa != 'A' ORDER BY username ASC";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Korisnik');
        return $stmt->fetchAll();
    }
    
    /**
     * Funkcija vraca podatke o korisniku na osnovu korisnickog imena
     * 
     * @param string $username
     * @return Korisnik
     */
    public static function dohvati($username){
        $sql = "SELECT * FROM korisnik WHERE username = :username";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam("username", $username);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Korisnik');
            return $stmt->fetch();
        } else {
            return NULL;
        }
    }
    
    /**
     * Funkcija azurira kolonu datuma prijave korisnika u bazi podataka
     * 
     * @param string $username
     * @return void
     */
    public static function azurirajVremePrijave($username){
        $now = new DateTime();
        $param = $now->format("Y-m-d H:i:s");
        $sql = "UPDATE korisnik SET datum_poslednje_prijave = :datum WHERE username = :username";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam("datum", $param);
        $stmt->bindParam("username", $username);
        $stmt->execute();
    }
    
    /**
     * Funkcija dodaje korisnika u bazu podataka
     * 
     * @param string $username
     * @param string $password
     * @param string $email
     * @return boolean - da li je upit uspesno izvrsen
     */
    public static function dodaj($username, $password, $email){
        if(self::dohvati($username) == NULL){
            $now = new DateTime();

            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO korisnik(username, password, email, grupa, datum_registracije, datum_poslednje_prijave)"
                    . " VALUES(?, ?, ?, ?, ?, ?)";
            $stmt = Connection::getInstance()->prepare($sql);
            return $stmt->execute([$username, $passwordHash, $email, 'R', $now->format("Y-m-d H:i:s"), $now->format("Y-m-d H:i:s")]);
        }
        else{
            return false;
        }
    }
    
    /**
     * Funkcija vraca sve korisnike koje ulogovani korisnik nije ocenio a ucestvovali su u izabranom terminu
     * 
     * @param string $username
     * @param int $termin
     * @return Korisnik[] - Lista korisnika
     */
    public static function dohvatiSveKojeNisamOcenio($username, $termin){
        $sql = "SELECT * FROM korisnik WHERE username != :username AND "
                . "(username IN "
                . "(SELECT username FROM zahtev WHERE IDTermin = :termin AND odgovor ='P') OR "
                . "username IN "
                . "(SELECT username FROM termin WHERE IDTermin = :termin)) AND "
                . "username NOT IN "
                . "(SELECT username_ocenjeni FROM ocena WHERE username_ocenjivac = :username AND IDTermin = :termin)";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam("username", $username);
        $stmt->bindParam("termin", $termin, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Korisnik');
    }
    
    /**
     * Funkcija uvecava ocenu izabranog korisnika za prosledjenu vrednost
     * 
     * @param string $username
     * @param int $ocena
     * @return void
     */
    public static function uvecajOcenu($username, $ocena){
        $sql = "UPDATE korisnik SET zbir_ocena = zbir_ocena + ?, broj_ocena = broj_ocena + 1 where username = ?";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam(1, $ocena, PDO::PARAM_INT);
        $stmt->bindParam(2, $username);
        $stmt->execute();
    }
    
    /**
     * Funkcija za banovanje korisnika
     * 
     * @param string $username
     * @return void
     */
    public static function banuj($username){
        $sql = "UPDATE korisnik SET grupa = 'B' WHERE username = ?";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->execute();
    }
    
    /**
     * Funkcija za ukidanje bana korisniku
     * 
     * @param string $username
     * @return void
     */
    public static function odbanuj($username){
        $sql = "UPDATE korisnik SET grupa = 'R' WHERE username = ?";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->execute();
    }
    
    /**
     * Funkcija za unapredjivanje korisnika u VIP
     * 
     * @param string $username
     * @return void
     */
    public static function unapredi($username){
        $sql = "UPDATE korisnik SET grupa = 'V' WHERE username = ?";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->execute();
    }
    
    /**
     * Funkcija za vracanje ranka korisnika sa VIP na REGISTROVANI KORISNIK
     * 
     * @param string $username
     * @return void
     */
    public static function degradiraj($username){
        $sql = "UPDATE korisnik SET grupa = 'R' WHERE username = ?";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->execute();
    }
    
}