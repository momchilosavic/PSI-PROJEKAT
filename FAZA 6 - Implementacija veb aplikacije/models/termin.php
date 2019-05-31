<?php

/* 
 * 
 * File: termin.php
 * Author: Momcilo Savic 0586/2016
 * 
 *  */

/**
 * Termin - Klasa za rad sa tabelom Termin u bazi podataka
 * 
 */
class Termin{
    /**
     *
     * @var int
     */
    public $IDTermin;
    /**
     *
     * @var string Naslov termina
     */
    public $naslov;
    /**
     *
     * @var string 
     */
    public $sport;
    /**
     *
     * @var string Adresa sportskog objekta gde se odrzava termin
     */
    public $adresa;
    /**
     *
     * @var DateTime Datum i vreme odrzavanja termina
     */
    public $datum;
    /**
     *
     * @var float Cena termina
     */
    public $cena;
    /**
     *
     * @var int
     */
    public $broj_potrebnih_igraca;
    /**
     *
     * @var int
     */
    public $broj_prijavljenih_igraca;
    /**
     *
     * @var string
     */
    public $opis;
    /**
     *
     * @var string Korisnicko ime kreatora termina
     */
    public $username;
    /**
     *
     * @var float Ocena kreatora termina
     */
    public $ocena;
    /**
     *
     * @var DateTime Datum kreiranja termina
     */
    public $datum_kreiranja;
    
    /**
     * Funkcija vraca sve aktivne termine za izabrani sport
     * 
     * @param string $sport
     * @return Termin
     */
    public static function dohvatiSveAktivne($sport){
        $sql = "SELECT * FROM termin WHERE sport = :sport AND TIMEDIFF(datum, CURRENT_TIMESTAMP()) > 0 ORDER BY datum DESC";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam("sport", $sport);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Termin');
    }
    
    /**
     * Funkcija vraca sve aktive termine ulogovanog korisnika
     * 
     * @param string $username
     * @return Termin
     */
    public static function dohvatiSveMojeAktivneKreirane($username){
        $sql = "SELECT * FROM termin WHERE TIMEDIFF(datum, CURRENT_TIMESTAMP()) > 0"
                . " AND username = :username ORDER BY datum ASC";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam("username", $username);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Termin');
    }
    
    /**
     * Funkcija vraca sve aktivne termine za koje su prihvaceni zahtevi za ucesce ulogovanog korisnika
     * 
     * @param string $username
     * @return Termin
     */
    public static function dohvatiSveMojeAktivnePrihvacene($username){
        $sql = "SELECT * FROM termin WHERE TIMEDIFF(datum, CURRENT_TIMESTAMP()) > 0"
                . " AND IDTermin IN (SELECT IDTermin FROM zahtev WHERE username = :username AND odgovor = 'P') ORDER BY datum ASC";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam("username", $username);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Termin');
    }
    
    /**
     * Funkcija vraca sve aktivne termine za koje su zahtevi ulogovanog korisnika jos neodgovoreni
     * 
     * @param string $username
     * @return Termin
     */
    public static function dohvatiSveMojeNaCekanju($username){
        $sql = "SELECT * FROM termin WHERE TIMEDIFF(datum, CURRENT_TIMESTAMP()) > 0"
                . " AND IDTermin IN (SELECT IDTermin FROM zahtev WHERE username = :username AND odgovor IS NULL) ORDER BY datum ASC";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam("username", $username);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Termin');
    }
    
    /**
     * Funkcija vraca sve aktivne termine za izabrani sport na koje se ulogovani korisnik nije prijavio, i koje nije organizovao
     * 
     * @param string $username
     * @param string $sport
     * @return Termin
     */
    public static function dohvatiSveAktivneUKojimaNeUcestvujem($username, $sport){
        $sql = "SELECT * FROM termin WHERE sport = :sport AND TIMEDIFF(datum, CURRENT_TIMESTAMP()) > 0 AND "
                . "broj_prijavljenih_igraca < broj_potrebnih_igraca"
                . " AND username <> :username AND IDTermin NOT IN (SELECT IDTermin FROM zahtev WHERE username = :username) ORDER BY datum ASC";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam("sport", $sport);
        $stmt->bindParam("username", $username);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Termin');
    }   
    
    /**
     * Funkcija umanjuje broj igraca za izabrani termin
     * 
     * @param int $termin
     */
    public static function umanjiBrojIgraca($termin){
        $sql = "UPDATE termin SET broj_prijavljenih_igraca = broj_prijavljenih_igraca - 1 WHERE IDTermin = ?";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam(1, $termin, PDO::PARAM_INT);
        $stmt->execute();
    }
    
    /**
     * Funkcija uvecava broj igraca za izabrani termin
     * 
     * @param int $termin
     */
    public static function uvecajBrojIgraca($termin){
        $sql = "UPDATE termin SET broj_prijavljenih_igraca = broj_prijavljenih_igraca + 1 WHERE IDTermin = ?";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam(1, $termin, PDO::PARAM_INT);
        $stmt->execute();
    }
    
    public static function obrisi($termin){
        $sql = "DELETE FROM termin WHERE IDTermin = ?";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam(1, $termin, PDO::PARAM_INT);
        $stmt->execute();
    }
    
    public static function dohvatiSveMojeNeaktivnePrihvaceneIKreirane($username){
        $sql = "SELECT * FROM termin WHERE TIMEDIFF(datum, CURRENT_TIMESTAMP()) <= 0 AND "
                . "(IDTermin IN (SELECT IDTermin FROM zahtev WHERE odgovor = 'P' AND username = :username) OR "
                . "username = :username) ORDER BY datum ASC";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam("username", $username);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Termin');
    }
    
    public static function azurirajOcenu($username){
        $sql = "SELECT zbir_ocena, broj_ocena FROM korisnik WHERE username = ?";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $ocena = bcadd($result['zbir_ocena']/$result['broj_ocena'], '0', 1);
        
        $sql = "UPDATE termin SET ocena = ? WHERE IDTermin = ?";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam(1, $ocena);
        $stmt->bindParam(2, $username);
        $stmt->execute();
    }
    
    public static function napravi($naslov, $sport, $adresa, $datum, $cena, $broj_potrebnih_igraca, $opis, $username){
        $now = (new DateTime())->format("Y-m-d H:i:s");
        require_once 'models/ocena.php';
        $ocena = Ocena::dohvati($username);
        if(!strcmp($ocena, 'NEOCENJEN'))
            $ocena = 0;
        $sql = "INSERT INTO termin (naslov, sport, adresa, datum, cena, broj_potrebnih_igraca, opis, username, ocena, datum_kreiranja)"
                . " VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam(1, $_GET['naslov']);
        $stmt->bindParam(2, $_GET['sport']);
        $stmt->bindParam(3, $_GET['adresa']);
        $stmt->bindParam(4, $_GET['datum']);
        $stmt->bindParam(5, $_GET['cena']);
        $stmt->bindParam(6, $_GET['broj_potrebnih_igraca']);
        $stmt->bindParam(7, $_GET['opis']);
        $stmt->bindParam(8, $_SESSION['username']);
        $stmt->bindParam(9, $ocena);
        $stmt->bindParam(10, $now);
        $stmt->execute();
    }
    
    public static function obrisiSveMojeAktivne($username){        
        $sql = "SELECT IDTermin FROM termin WHERE username = ? AND TIMEDIFF(datum, CURRENT_TIMESTAMP()) > 0";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($result as $r){
            $sql = "DELETE FROM zahtev WHERE IDTermin = ?";
            $stmt = Connection::getInstance()->prepare($sql);
            $stmt->bindParam(1, $r['IDTermin']);
            $stmt->execute();
        
            $sql = "DELETE FROM termin WHERE IDTermin = ?";
            $stmt = Connection::getInstance()->prepare($sql);
            $stmt->bindParam(1, $r['IDTermin']);
            $stmt->execute();
        }
        
        $sql = "SELECT IDTermin FROM zahtev WHERE username = ?";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($result as $r){
            $sql = "DELETE FROM zahtev WHERE IDTermin = ?";
            $stmt = Connection::getInstance()->prepare($sql);
            $stmt->bindParam(1, $r['IDTermin']);
            $stmt->execute();
            $sql = "UPDATE termin SET broj_prijavljenih_igraca = broj_prijavljenih_igraca - 1 WHERE IDTermin = ?";
            $stmt = Connection::getInstance()->prepare($sql);
            $stmt->bindParam(2, $r['IDTermin']);
            $stmt->execute();
        }
    }
    
    public static function dohvatiSve(){
        $sql = "SELECT * FROM termin WHERE TIMEDIFF(datum, CURRENT_TIMESTAMP()) > 0 ORDER BY naslov ASC";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Termin');
    }
};

?>