<?php

/*
 * 
 * File: baloni.php
 * Author: Momcilo Savic 0586/2016
 * 
 */

/**
 * Balon - Klasa za rad sa tabelom balon u bazi podataka
 * 
 * @version 1.0
 */
class Balon{
    public $id;
    public $naziv;
    public $adresa;
    public $veb_sajt;
    public $slika;
    public $username;
    public $datum_reklamiranja;
    
    /**
     * Funkcija vraca sve sportske objekte iz baze podataka
     * 
     * @return Balon
     */
    public static function dohvatiSve(){
        $sql = "SELECT * FROM sportski_objekat";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Balon');
    }
    
    /**
     * Funkcija brise sportski objekat iz baze podataka
     * 
     * @param int $balon - id sportskog objekta
     * 
     * @return void
     */
    public static function obrisi($balon){
        $sql = "DELETE FROM sportski_objekat WHERE IDObjekat = :id";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam("id", $balon);
        $stmt->execute();
    }
    
}