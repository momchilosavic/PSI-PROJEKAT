<!DOCTYPE HTML>

<!--

File: termini.php
Author: Momcilo Savic

-->

<style>
    /* width */
    .termini::-webkit-scrollbar {
        width: 1%;
	background-color: #F5F5F5;
    }
    /* Track */
    .termini::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	border-radius: 10px;
	background-color: #F5F5F5;
    }
    /* Handle */
    .termini::-webkit-scrollbar-thumb {
      border-radius: 10px;
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
	background-color: #555;
    }
    .termini::-webkit-scrollbar:hover -webkit-scrollbar-thumb{background:green;}
    /* Handle on hover */
    .termini::-webkit-scrollbar-thumb:hover {
      background: #666; 
    }
    .termini{
        width:75%;
        box-sizing: border-box;
        display:inline-block;
        padding-top: 2%;
        padding-left: 5%;
        padding-right: 10%;
        min-height: 20vw;
        overflow-y:scroll;
        overflow-x:hidden;
        max-height: 40vw;
    }
    .termini:empty:before{
        content:"\200b";
    }
    .termini .row {
            background-color: white;
            box-sizing: border-box;
            padding: 1%;
            float: left;
            width: 100%;
            border: solid;
            border-width: 1%;
            border-color: gray;
            max-height: 30%;
            margin-bottom: 3%;
            word-break: break-all;
            white-space: normal;
    }

    /* Clear floats after the columns */
    .termini .row:after {
      content: "";
      display: table;
      clear: both;
    }

    /* Responsive layout - makes the three columns stack on top of each other instead of next to each other on smaller screens (600px wide or less) */
    @media screen and (max-height: 600px) and (min-width: 600px) {
     .termini .row {
        width: 100%;
            max-height:40%;
      }
    }

    .termini .datum_vreme{
            display: inline-block;
            float: left;
            padding: 1%;
            height: 100%;
            width: 15%;
    }

    .termini .datum{
            border-right: solid;
            border-bottom: solid;
            border-width: 1px;
            border-color: gray;
            text-align: center;
            font-weight: bold;
            font-size: 3vw;
    }
    .termini .vreme{
            color: gray;
            text-align: center;
            font-size: 3vw;
    }


    .termini .info{
            float: right;
            display: inline-block;
            width: 80%;
            text-align: right;
            height: 100%;
    }

    .termini .info .osnovno{
            padding-right: 1%;
            display: inline-block;
            width: 30%;
            float: left;
            border-right: solid;
            border-color: black;
            border-width: 1px;
    }

    .termini .info .opis{
            display: inline-block;
            float: right;
            font-size: 1.5vw;
            width: 60%;
            font-style: italic;
            color: gray;
    }

    .termini .naslov{
            font-size: 3vw;
    }

    .termini .adresa{
            font-size: 2vw;
            font-style: italic;
            color: gray;
    }

    .termini .cena{
            font-size: 1.75vw;
    }
    .termini .korisnik{
            font-size: 1.5vw;
            padding-top: 1vh;
            font-style: italic;
            color: #4CAF50;
    }

    .termini .br_igraca{
            font-size: 1vw;
            font-style: italic;
    }
    .termini .b{
        bottom: 0;
        padding: 2% 0;
    }
    .termini button{
	-webkit-transition-duration: 0.4s; /* Safari */
	transition-duration: 0.4s;
	padding: 2%;
	font-size: 1vw;
    }
    .termini button:hover{
            cursor: pointer;
    }
    .termini a{
        text-decoration: none;
        color: black;
    }
</style>

<div class="termini">
    <p style="font-size:1.5vw; color:white; padding: 0 5%; margin: 0; margin-bottom: 2%;">
        <?php echo '' . ucfirst($_POST['sport']); ?>
    <hr>
    </p>
    
<?php
$controller = $_GET['controller'];
require_once 'controllers/' . $controller . 'controller.php';
switch($controller){
    case 'korisnik': $controller = 'KorisnikController'; break;
    case 'vip': $controller = 'VIPController'; break;
    case 'admin': $controller = 'AdminController'; break;
}

    foreach($controller::$termini as $termin){

        $datum = DateTime::createFromFormat('Y-m-d H:i:s', $termin->datum);

        echo '<div class="row">';
            echo '<div class="datum_vreme">';
                echo '<div class="datum">';
                    echo '' . $datum->format("d") . '<br>' . $datum->format("M");
                echo '</div>';
                echo '<div class="vreme">';
                    echo '' . $datum->format("H:i");
                echo '</div>';
            echo '</div>';
            echo '<div class="info">';
                echo '<div class="osnovno">';
                    echo '<div class="naslov">';
                        echo '' . $termin->naslov;
                    echo '</div>';
                    echo '<div class="adresa">';
                        echo '' . $termin->adresa;
                    echo '</div>';
                    echo '<div class="cena">';
                        echo '' . $termin->cena . 'rsd';
                    echo '</div>';
                    echo'<div class="br_igraca">';
                        echo 'Igrači: ' . $termin->broj_prijavljenih_igraca . '/' . $termin->broj_potrebnih_igraca;
                    echo '</div>';
                    echo'<div class="korisnik">';
                        echo '' . $termin->username . ' &#9734 ';
                        echo '<span class="rejting"> ';
                            if($termin->ocena == 0){
                                echo 'NEOCENJEN';
                            }else{
                                echo '' . bcadd($termin->ocena, '0', 1);
                            }
                        echo'</span>';
                    echo '</div>';					
                echo '</div>';
                echo'<div class="opis">';
                    echo '' . $termin->opis;
                    if(isset($_POST['sport']) && !strcmp($_POST['sport'], 'termini u kojima ucestvujes')){
                        echo '<div class ="b"><button type="button"><a href="' .  $_SERVER['PHP_SELF'] . 
                                '?controller=korisnik&action=otkazi_prihvacen&termin=' . $termin->IDTermin . '">OTKAZI</a></button></div>'
                                . '<br><p style="color:green">Status: Prihvacen</p>';
                    }
                echo '</div>';
            echo '</div>';
        echo '</div>';	
    }
    
    foreach($controller::$termini2 as $termin){

        $datum = DateTime::createFromFormat('Y-m-d H:i:s', $termin->datum);

        echo '<div class="row">';
            echo '<div class="datum_vreme">';
                echo '<div class="datum">';
                    echo '' . $datum->format("d") . '<br>' . $datum->format("M");
                echo '</div>';
                echo '<div class="vreme">';
                    echo '' . $datum->format("H:i");
                echo '</div>';
            echo '</div>';
            echo '<div class="info">';
                echo '<div class="osnovno">';
                    echo '<div class="naslov">';
                        echo '' . $termin->naslov;
                    echo '</div>';
                    echo '<div class="adresa">';
                        echo '' . $termin->adresa;
                    echo '</div>';
                    echo '<div class="cena">';
                        echo '' . $termin->cena . 'rsd';
                    echo '</div>';
                    echo'<div class="br_igraca">';
                        echo 'Igrači: ' . $termin->broj_prijavljenih_igraca . '/' . $termin->broj_potrebnih_igraca;
                    echo '</div>';
                    echo'<div class="korisnik">';
                        echo '' . $termin->username . ' &#9734 ';
                        echo '<span class="rejting"> ';
                            if($termin->ocena == 0){
                                echo 'NEOCENJEN';
                            }else{
                                echo '' . bcadd($termin->ocena, '0', 1);
                            }
                        echo'</span>';
                    echo '</div>';					
                echo '</div>';
                echo'<div class="opis">';
                    echo '' . $termin->opis;
                    if(isset($_POST['sport']) && !strcmp($_POST['sport'], 'termini u kojima ucestvujes')){
                        echo '<div class ="b"><button type="button"><a href="' .  $_SERVER['PHP_SELF'] . 
                                '?controller=korisnik&action=otkazi&termin=' . $termin->IDTermin . '">OTKAZI</a></button></div>'
                                . '<br><p style="color:blue">Status: Na cekanju</p>';
                    }
                echo '</div>';
            echo '</div>';
        echo '</div>';	
    } 
    
    foreach($controller::$termini3 as $termin){

        $datum = DateTime::createFromFormat('Y-m-d H:i:s', $termin->datum);


        echo '<div class="row">';
            echo '<div class="datum_vreme">';
                echo '<div class="datum">';
                    echo '' . $datum->format("d") . '<br>' . $datum->format("M");
                echo '</div>';
                echo '<div class="vreme">';
                    echo '' . $datum->format("H:i");
                echo '</div>';
            echo '</div>';
            echo '<div class="info">';
                echo '<div class="osnovno">';
                    echo '<div class="naslov">';
                        echo '' . $termin->naslov;
                    echo '</div>';
                    echo '<div class="adresa">';
                        echo '' . $termin->adresa;
                    echo '</div>';
                    echo '<div class="cena">';
                        echo '' . $termin->cena . 'rsd';
                    echo '</div>';
                    echo'<div class="br_igraca">';
                        echo 'Igrači: ' . $termin->broj_prijavljenih_igraca . '/' . $termin->broj_potrebnih_igraca;
                    echo '</div>';
                    echo'<div class="korisnik">';
                        echo '' . $termin->username . ' &#9734 ';
                        echo '<span class="rejting"> ';
                            if($termin->ocena == 0){
                                echo 'NEOCENJEN';
                            }else{
                                echo '' . bcadd($termin->ocena, '0', 1);
                            }
                        echo'</span>';
                    echo '</div>';					
                echo '</div>';
                echo'<div class="opis">';
                    echo '' . $termin->opis;
                    if(isset($_POST['sport']) && !strcmp($_POST['sport'], 'termini u kojima ucestvujes')){
                        echo '<div class ="b"><button type="button"><a href="' .  $_SERVER['PHP_SELF'] . 
                                '?controller=korisnik&action=otkazi_kreiran&termin=' . $termin->IDTermin . '">OTKAZI</a></button></div>'
                                . '<br><p style="color:orchid">Status: Moj termin</p>';
                    }
                echo '</div>';
            echo '</div>';
        echo '</div>';	
    }
    
echo '</div>';

?>