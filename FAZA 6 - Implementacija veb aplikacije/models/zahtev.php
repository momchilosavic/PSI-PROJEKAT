<?php

/*
 * 
 * File: zahtev.php
 * Author: Momcilo Savic 0586/2016
 * 
 */

/**
 * Zahtev - Klasa za rad sa tabelom Zahtev u bazi podataka
 * 
 */
class Zahtev{
    /**
     *
     * @var string Korisnicko ime korisnika koji salje zahtev
     */
    public $username;
    /**
     *
     * @var int Termin za koji se salje zahtev
     */
    public $IDTermin;
    /**
     *
     * @var char Odgovor na zahtev(P - prihvacen, O-odbijen)
     */
    public $odgovor;
    /**
     *
     * @var DateTime
     */
    public $datum_zahteva;
    /**
     *
     * @var DateTime
     */
    public $datum_odgovora;
    
    /**
     *
     * @var string Naslov termina za koji se salje zahtev
     */
    public $naslov;
    /**
     *
     * @var string Adresa termina za koji se salje zahtev
     */
    public $adresa;
    /**
     *
     * @var DateTime Datum i vreme odrzavanja termina
     */
    public $datum;
    
    /**
     * Funkcija za kreiranje zahteva u bazi podataka
     * 
     * @param string $username
     * @param Termin $termin
     * @return void
     */
    public static function posalji($username, $termin){
        $now = (new DateTime())->format("Y-m-d H:i:s");
        $sql = "INSERT INTO zahtev(username, IDTermin, datum_zahteva) VALUES (:username, :id, :datum)";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam("username", $username);
        $stmt->bindParam("id", $termin);
        $stmt->bindParam("datum", $now);
        $stmt->execute();
    }
    
    /**
     * Funkcija za brisanje zahteva iz baze podataka
     * 
     * @param string $username
     * @param int $termin
     */
    public static function obrisi($username, $termin){
        $sql = "DELETE FROM zahtev WHERE IDTermin = ? AND username = ?";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam(2, $username);
        $stmt->bindParam(1, $termin, PDO::PARAM_INT);
        $stmt->execute();
    }
    
    /**
     * Funkcija brise sve zahteve za izabrani termin
     * 
     * @param int $termin
     * @return void
     */
    public static function obrisiSve($termin){
        $sql = "DELETE FROM zahtev WHERE IDTermin = ?";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam(1, $termin, PDO::PARAM_INT);
        $stmt->execute();
    }
    
    /**
     * Funkcija vraca sve zahteve za aktivne termine ciji je kreator prosledjeni korisnik
     * 
     * @param string $username
     * @return Zahtev
     */
    public static function dohvatiSveNaCekanjuZaMojTermin($username){
        $sql = "SELECT zahtev.username, zahtev.IDTermin, zahtev.odgovor, zahtev.datum_zahteva, zahtev.datum_odgovora, "
                . "termin.naslov, termin.adresa, termin.datum "
                . "FROM zahtev "
                . "INNER JOIN termin ON zahtev.IDTermin = termin.IDTermin AND termin.username = ? AND zahtev.odgovor IS NULL "
                . "AND termin.broj_prijavljenih_igraca < termin.broj_potrebnih_igraca "
                . "AND TIMEDIFF(datum, CURRENT_TIMESTAMP()) > 0 "
                . "ORDER BY zahtev.datum_zahteva DESC";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Zahtev');
    }
    
    /**
     * Funkcija vraca sve zahteve za termine ciji je kreator prosledjeni korisnik
     * @param string$username
     * @return Zahtev
     */
    public static function dohvatiSveMojeOdgovorene($username) {
        $sql = "SELECT zahtev.username, zahtev.IDTermin, zahtev.odgovor, zahtev.datum_zahteva, zahtev.datum_odgovora, "
                . "termin.naslov, termin.adresa, termin.datum "
                . "FROM zahtev "
                . "INNER JOIN termin ON zahtev.IDTermin = termin.IDTermin AND termin.username = ? AND zahtev.odgovor IS NOT NULL "
                . "ORDER BY zahtev.datum_zahteva DESC";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Zahtev');
    }
    
    /**
     * Funkcija za prihvatanje zahteva prosledjenog korisnika za prosledjeni zahtev
     * 
     * @param string $username
     * @param int $termin
     */
    public static function prihvati($username, $termin){
        $now = (new DateTime())->format("Y-m-d H:i:s");
        $sql = "UPDATE zahtev SET odgovor = 'P', datum_odgovora = ? WHERE username = ? AND IDTermin = ?";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam(1, $now);
        $stmt->bindParam(2, $username, PDO::PARAM_STR);
        $stmt->bindParam(3, $termin, PDO::PARAM_INT);
        $stmt->execute();
        $sql = "SELECT zahtev.username, zahtev.IDTermin, zahtev.odgovor, zahtev.datum_zahteva, zahtev.datum_odgovora, "
                . "termin.naslov, termin.adresa, termin.datum "
                . "FROM zahtev "
                . "INNER JOIN termin ON termin.IDTermin = zahtev.odgovor IS NULL AND zahtev.IDTermin AND zahtev.IDTermin = ? AND termin.broj_potrebnih_igraca - termin.broj_prijavljenih_igraca = 1";
        $stmt2 = Connection::getInstance()->prepare($sql);
        $stmt2->bindParam(1, $termin, PDO::PARAM_INT);
        $stmt2->execute();
        $result = $stmt2->fetchAll(PDO::FETCH_CLASS, 'Zahtev');
        foreach($result as $z){
            self::odbij($z->username, $termin);
        }
    }
    
    /**
     * Funkcija za odbijanje zahteva prosledjenog korisnika za prosledjeni zahtev
     * 
     * @param string $username
     * @param int $termin
     */
    public static function odbij($username, $termin){
        $now = (new DateTime())->format("Y-m-d H:i:s");
        $sql = "UPDATE zahtev SET odgovor = 'O', datum_odgovora = ? WHERE username = ? AND IDTermin = ?";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam(1, $now);
        $stmt->bindParam(2, $username, PDO::PARAM_STR);
        $stmt->bindParam(3, $termin, PDO::PARAM_INT);
        $stmt->execute();
    }
}