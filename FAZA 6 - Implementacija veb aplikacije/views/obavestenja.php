<!DOCTYPE HTML>

<!--
 
 File: obavestenja.php
 Author: Momcilo Savic
  
 -->
 <style>
      /* width */
    .obavestenja::-webkit-scrollbar, .zahtevi::-webkit-scrollbar {
        width: 1%;
	background-color: #F5F5F5;
    }
    /* Track */
    .obavestenja::-webkit-scrollbar-track, .zahtevi::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	border-radius: 10px;
	background-color: #F5F5F5;
    }
    /* Handle */
    .obavestenja::-webkit-scrollbar-thumb, .zahtevi::-webkit-scrollbar-thumb {
      border-radius: 10px;
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
	background-color: #555;
    }
    /* Handle on hover */
    .obavestenja::-webkit-scrollbar-thumb:hover, .zahtevi::-webkit-scrollbar-thumb:hover {
      background: #666; 
    }
     .obavestenja{
	box-sizing: border-box;
	display: inline-block;
	float:right;
	width: 50%;
	padding-left: 1%;
	box-sizing: border-box;
        color: beige;
        overflow-y: scroll;
        overflow-x:hidden;
        min-height: 40vw;
    }
    .zahtevi{
            box-sizing: border-box;
            padding-right: 1%;
            display: inline-block;
            float:left;
            width: 50%;
            color: beige;
            overflow-y:scroll;
            overflow-x:hidden;
    }

    .zahtevi .title, .obavestenja .title{
            padding: 0 1%;
            font-size: 1.5vw;
            border-bottom: solid;
            margin-bottom: 2%;
    }

    .obavestenja .row, .zahtevi .row{
	padding: 1%;
	float: left;
	width: 100%;
	border: none;
	border-width: 1px;
	border-color: gray;
	max-height: 25%;
	margin-bottom: 3%;
	font-size: 1.5vw;
	padding-bottom: 2%;
    }

    /* Clear floats after the columns */
    .obavestenja .row:after, .zahtevi .row:after {
      display: table;
      clear: both;
    }

    /* Responsive layout - makes the three columns stack on top of each other instead of next to each other on smaller screens (600px wide or less) */
    @media screen and (max-height: 600px) and (min-width: 600px) {
     .obavestenja .row, .zahtevi .row {
        width: 100%;
            max-height:40%;
      }
    }

    .obavestenja .datum, .zahtevi .datum{
            font-size: 1vw;
            font-style: italic;
            color: gray;
            border-bottom: solid;
            border-width: 1px;
            width: auto;
            padding-bottom: 1%;
    }

    .obavestenja button, .zahtevi button{
            -webkit-transition-duration: 0.4s; /* Safari */
            transition-duration: 0.4s;
            font-size: 1vw;
            padding: 1%;
    }

    .obavestenja span, .zahtevi span{
            font-weight: bold;
    }


    .obavestenja button:hover, .zahtevi button:hover{
            cursor: pointer;
    }

    .obavestenja .row, .zahtevi .row{
            width: 100%;
    }
    .zahtevi a{
        color: black;
        text-decoration: none;
    }
    .zahtevi .b{
        display:inline-block;
        margin-left:2%;
    }
 </style>
 <div class="zahtevi">
    <div class="title">
        ZAHTEVI
    </div>
<?php
$controller = $_GET['controller'];
require_once 'controllers/' . $controller . 'controller.php';
switch($controller){
    case 'korisnik': $controller = 'KorisnikController'; break;
    case 'vip': $controller = 'VIPController'; break;
    case 'admin': $controller = 'AdminController'; break;
}

    foreach($controller::$zahtevi1 as $zahtev){
        
        $datum = new DateTime($zahtev->datum);
        
        echo '<div class="zahtev_na_cekanju row" id="1">';
            echo '<div class="datum">';
                echo '' . (new DateTime($zahtev->datum_zahteva))->format("d.m.Y H:i");
            echo '</div>';
            echo '<span>' . $zahtev->username . ' je poslao/la zahtev za ' . $zahtev->naslov . ' na adresi "' .
                    $zahtev->adresa . '" u ' . $datum->format("H:i") . ' dana ' . 
                    $datum->format("d.m.Y") . '</span>';
            
            echo '<div class ="b"><button type="button"><a href="' .  $_SERVER['PHP_SELF'] . 
                 '?controller=korisnik&action=prihvati&termin=' . $zahtev->IDTermin . '&korisnik=' . $zahtev->username . 
                    '">PRIHVATI</a></button></div>';
            
            echo '<div class ="b"><button type="button"><a href="' .  $_SERVER['PHP_SELF'] . 
                 '?controller=korisnik&action=odbij&termin=' . $zahtev->IDTermin . '&korisnik=' . $zahtev->username . 
                    '">ODBIJ</a></button></div>';
                               
        echo '</div>';
    }
?>
</div>
 
<div class="obavestenja">
    <div class="title">
	ODGOVORI
    </div>
<?php
    foreach($controller::$zahtevi2 as $zahtev){
        
        $datum = new DateTime($zahtev->datum);
        $odgovor = strcmp($zahtev->odgovor, 'P') ? 'Odbio' : 'Prihvatio';
         
        echo '<div class="odgovor row">';
            echo '<div class="datum">';
                echo '' . (new DateTime($zahtev->datum_odgovora))->format("d.m.Y H:i");
            echo '</div>';
            echo '<span>' . $odgovor . ' si ' .  $zahtev->username . ' za ' . $zahtev->naslov . ' na adresi "' . $zahtev->adresa
                    . '" u ' . $datum->format("H:i") . ' dana ' . 
                    $datum->format("d.m.Y") .'</span>';
        echo '</div>';
    }
?>
</div>

