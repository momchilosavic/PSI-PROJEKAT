<?php

/*
 * 
 * File: baloni.php
 * Author: Branislav Bajić 0599/2016
 * 
 */


class Balon{
    public $id;
    public $naziv;
    public $adresa;
    public $veb_sajt;
    public $slika;
    public $username;
    public $datum_reklamiranja;
    
	public static function dodaj($naziv, $adresa, $veb_sajt, $slika, $username){
		$now = new DateTime();
		$sql = "INSERT INTO sportski_objekat(naziv, adresa, veb_sajt, slika, username, datum_reklamiranja)". " VALUES(?, ?, ?, ?, ?, ?)";
		
		$stmt = Connection::getInstance()->prepare($sql);
		return $stmt->execute([$naziv, $adresa, $veb_sajt, $slika, $username, $now->format("Y-m-d H:i:s")]);
	}
	
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
	
	/**
	* Funkcija pronalazi sportski objekat na osnovu korisnika koji ga je kreirao
	*
	* @param string $username - username kreatora
	*
	* @return Balon
	*
	*/
	public static function dohvati($username){
		$sql = "SELECT * FROM sportski_objekat WHERE username = ?";
		$stmt = Connection::getInstance()->prepare($sql);
		$stmt->bindParam(1, $username);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_CLASS, 'Balon');
	}
    
}