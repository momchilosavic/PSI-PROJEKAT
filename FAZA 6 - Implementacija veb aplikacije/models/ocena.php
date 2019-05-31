<?php

/*
 * 
 * File: ocena.php
 * Author: Momcilo Savic 0586/2016
 * 
 */

/**
 * Ocena - Klasa za rad sa tabelom Ocena u bazi podaataka
 * 
 */
class Ocena{
    /**
     *
     * @var int Id termina
     */
    public $IDTermin;
    /**
     *
     * @var string Korisnicko ime ocenjenog korisnika
     */
    public $username_ocenjeni;
    /**
     *
     * @var string Korisnicko ime ocenjivaca
     */
    public $username_ocenjivac;
    /**
     *
     * @var int
     */
    public $ocena;
    /**
     *
     * @var string
     */
    public $razlog;
    /**
     *
     * @var DateTime
     */
    public $datum_ocenjivanja;
    
    /**
     * Funkcija za kreiranje nove ocene u bazi podataka
     * 
     * @param int $termin
     * @param string $username_rated
     * @param string $username_logged
     * @param int $ocena
     * @param string $razlog
     * @return void
     */
    public static function unesi($termin, $username_rated, $username_logged, $ocena, $razlog){
        $now = (new DateTime())->format("Y-m-d H:i:s");
        $sql = "INSERT INTO ocena VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam(1, $termin, PDO::PARAM_INT);
        $stmt->bindParam(2, $username_rated, PDO::PARAM_STR);
        $stmt->bindParam(3, $username_logged, PDO::PARAM_STR);
        $stmt->bindParam(4, $ocena, PDO::PARAM_INT);
        $stmt->bindParam(5, $razlog, PDO::PARAM_STR);
        $stmt->bindParam(6, $now);
        $stmt->execute();
    }
    
    /**
     * Funkcija vraca ocenu za izabranog korisnika
     * 
     * @param string $username
     * @return float/string - Vraca ocenu ako je korisnik barem 1 ocenjen, inace string da nije ocenjen
     */
    public static function dohvati($username){
        $sql = "SELECT zbir_ocena, broj_ocena FROM korisnik WHERE username = ?";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result['zbir_ocena'] != 0)
            return bcdiv($result['zbir_ocena'], $result['broj_ocena'], 1);
        else
            return 'NEOCENJEN';
    }
    
    /**
     * Funkcija vraca Listu ocena za izabranog korisnika
     * 
     * @param string $username
     * @return Ocena
     */
    public static function dohvatiSve($username){
        $sql = "SELECT * FROM ocena WHERE username_ocenjeni = ? ORDER BY IDTermin DESC";
        $stmt = Connection::getInstance()->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Ocena');
    }
}