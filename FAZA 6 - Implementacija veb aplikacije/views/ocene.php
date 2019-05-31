<!DOCTYPE HTML>

<!--

File: ocene.php
Author: Momcilo Savic

-->

<style>
      /* width */
    .column.lista::-webkit-scrollbar, .column.ocene::-webkit-scrollbar {
        width: 1%;
	background-color: #F5F5F5;
    }
    /* Track */
    .column.lista::-webkit-scrollbar-track, .column.ocene::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	border-radius: 10px;
	background-color: #F5F5F5;
    }
    /* Handle */
    .column.lista::-webkit-scrollbar-thumb, .column.ocene::-webkit-scrollbar-thumb {
      border-radius: 10px;
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
	background-color: #555;
    }
    /* Handle on hover */
    .column.lista::-webkit-scrollbar-thumb:hover, .column.ocene::-webkit-scrollbar-thumb:hover {
      background: #666; 
    }
    .oceni, .oceni a{
        color: beige;
        text-decoration: none;
    }
    .oceni .column{
	height:100%;
	box-sizing:border-box;
	width: 50%;
    }

    .oceni .column.ocene{
            box-sizing: border-box;
            display: inline-block;
            float:right;
            width: 50%;
            padding-left: 1%;
            box-sizing: border-box;
            overflow-y:scroll;
            overflow-x:hidden;
    }

    .oceni .column.lista{
            box-sizing: border-box;
            padding-right: 1%;
            display: inline-block;
            float:left;
            width: 50%;
            overflow-y:scroll;
    }

    .oceni .title{
            padding: 0 1%;
            font-size: 1.5vw;
            border-bottom: solid;
            margin-bottom: 3%;
    }

    .oceni .legenda{
            box-sizing:border-box;
            padding: 0 1%;
            font-size: 1vw;
            border-bottom: solid;
            margin-bottom: 1%;
            border-color:gray;
            border-width: 1px;
    }

    .oceni .lista .row, .oceni .ocene .row{
            padding: 1%;
            float: left;
            width: 100%;
            border: none;
            border-width: 1px;
            border-color: gray;
            max-height: 25%;
            margin-bottom: 1%;
            font-size: 1.5vw;
            padding-bottom: 2%;
    }

    .oceni .ocene .row, .oceni .lista .row{
            border-bottom: solid;
            border-width: 1px;
            border-color: lightgray;
            font-size: 1vw;
    }

    .oceni .ocene .row span, .oceni .ocene .legenda span{
            display:inline-block;
            box-sizing:border-box;
            width: 30%;
            text-align: left;
    }


    .oceni .lista .row span, .oceni .lista .legenda span{
            display:inline-block;
            box-sizing:border-box;
            width: 25%;
            text-align: left;
    }

    .oceni .lista .row .cena, .oceni .lista .legenda .cena{
            display:inline-block;
            box-sizing:border-box;
            width: 20%;
            text-align: left;
    }

    .oceni .ocene .dugmad{
	display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.6); /* Black w/ opacity */
        -webkit-animation-name: fadeIn; /* Fade in the background */
        -webkit-animation-duration: 0.4s;
        animation-name: fadeIn;
        animation-duration: 0.4s
    }

    .oceni .ocene .dugmad button{
            -webkit-transition-duration: 0.4s; /* Safari */
            transition-duration: 0.4s;
            font-size: 1vw;
            padding: 1%;
            margin:auto;
    }

    .oceni .ocene .dugmad button:hover{
            cursor:pointer;
    }

    .oceni .ocene .dugmad #z1,.oceni .ocene .dugmad #z2,.oceni .ocene .dugmad #z3,.oceni .ocene .dugmad #z4,.oceni .ocene .dugmad #z5{
            cursor:pointer;
    } 

    .oceni .ocene .dugmad #z:hover{
            color:gold;
    }

    .oceni .ocene .dugmad #z1:hover ~ span, .oceni .ocene .dugmad #z2:hover ~ span, .oceni .ocene .dugmad #z3:hover ~ span, .oceni .ocene .dugmad #z4:hover ~ span{
            color:black;
    }

    .oceni .ocene .dugmad #z{
            font-size:1.5vw;
    }

    .oceni .ocene .dugmad div{
            width:50%;
            display: inline-block;
            box-sizing: border-box;
            float: left;
            padding-bottom: 5%;
            padding-left: 1%;
            padding-right:1%;
    }

    .oceni .ocene .dugmad textarea{
            width:100%;
            height:8vw;
    }
    .oceni .row:hover{
        background-color: rgba(255,255,255,0.1);
        border-radius: 5%;
    }
    #modal_ocena{
        box-sizing: border-box;
        position: fixed;
        background-color: #eeeeee;
        width: 100%;
        border-color: blue;
        border-width: 1vw;
        border: solid;
        bottom: 5%;
        left: 50%;
        transform: translateX(-50%);
        -webkit-animation-name: slideIn;
        -webkit-animation-duration: 0.4s;
        animation-name: slideIn;
        animation-duration: 0.4s;
        color: black;
        font-size: 1vw;
    }
    @-webkit-keyframes slideIn {
        from {bottom: -300px; opacity: 0} 
        to {bottom: 0; opacity: 1}
      }

      @keyframes slideIn {
        from {bottom: -300px; opacity: 0}
        to {bottom: 0; opacity: 1}
      }

      @-webkit-keyframes fadeIn {
        from {opacity: 0} 
        to {opacity: 1}
      }

      @keyframes fadeIn {
        from {opacity: 0} 
        to {opacity: 1}
      }
</style>

<script>
    var ocena = 0;
    var razlog = "";
    var kor = "";
  
    window.onload = function(){
        if(document.getElementById("z") != null){
            document.getElementById("z"+1).addEventListener("click",function(){
                    ocena = 1;
                    document.getElementById("z").style.border="none";
                    this.style.color="gold";
                    document.getElementById("z2").style.color="black";
                    document.getElementById("z3").style.color="black";
                    document.getElementById("z4").style.color="black";
                    document.getElementById("z5").style.color="black";
            });
            document.getElementById("z"+2).addEventListener("click",function(){
                    ocena = 2;
                    document.getElementById("z").style.border="none";
                    this.style.color="gold";
                    document.getElementById("z1").style.color="gold";
                    document.getElementById("z3").style.color="black";
                    document.getElementById("z4").style.color="black";
                    document.getElementById("z5").style.color="black";
            });
            document.getElementById("z"+3).addEventListener("click",function(){
                    ocena = 3;
                    document.getElementById("z").style.border="none";
                    this.style.color="gold";
                    document.getElementById("z1").style.color="gold";
                    document.getElementById("z2").style.color="gold";
                    document.getElementById("z4").style.color="black";
                    document.getElementById("z5").style.color="black";
            });
            document.getElementById("z"+4).addEventListener("click",function(){
                    ocena = 4;
                    document.getElementById("z").style.border="none";
                    this.style.color="gold";
                    document.getElementById("z1").style.color="gold";
                    document.getElementById("z2").style.color="gold";
                    document.getElementById("z3").style.color="gold";
                    document.getElementById("z5").style.color="black";
            });
            document.getElementById("z"+5).addEventListener("click",function(){
                    ocena = 5;
                    document.getElementById("z").style.border="none";
                    this.style.color="gold";
                    document.getElementById("z1").style.color="gold";
                    document.getElementById("z2").style.color="gold";
                    document.getElementById("z3").style.color="gold";
                    document.getElementById("z4").style.color="gold";
            });

            document.getElementsByTagName("textarea")[0].addEventListener("keyup",function(){
                    this.style.borderColor="gray";
            });
        }
    }
    
    function checkOcena(){
        razlog = document.getElementById("opis").value;
        if(ocena != 0 && razlog!=""){
            var url = window.location.href;
            var razdvoj = url.split('&action=oceni');
            url = '' + razdvoj[0] + '&action=potvrdi' + '&termin=' + <?php echo $_GET['termin'] ?> + '&korisnik=' + kor + '&ocena=' + ocena + '&razlog=' + razlog;
            ocena = 0;
            razlog = "";
            window.location.replace("" + url);
	}
	else{
		if(ocena==0){
			document.getElementById("z").style.border="thin solid red";
		}
		if(razlog==""){
			document.getElementsByTagName("textarea")[0].style.borderColor="red";
		}
	}
    }
    
    function openModal(username){
        document.getElementById("modal_wrapper").style.display = "block";
        document.getElementById("" + username).style.borderRadius = "5%";
        document.getElementById("" + username).style.backgroundColor = "rgba(255,255,255,0.2)";
        document.getElementById("kor").textContent = username;
        kor = username;
    }
    
    function closeModal(){
        document.getElementById("modal_wrapper").style.display="none";
        kor = "";
        
    }
</script>

<div class ="oceni">
    <div class="lista column">
        <div class="title">
            LISTA TERMINA
	</div>
	<div class="legenda">
            <span class="naslov">NAZIV
            </span>
            <span class="vreme">VREME
            </span>
            <span class="adresa">ADRESA
            </span>
            <span class="cena">CENA
            </span>
        </div>
<?php			
$ctrl = $_GET['controller'];
$controller;
require_once 'controllers/' . $ctrl . 'controller.php';
switch($ctrl){
    case 'korisnik': $controller = 'KorisnikController'; break;
    case 'vip': $controller = 'VIPController'; break;
    case 'admin': $controller = 'AdminController'; break;
}

    foreach($controller::$termini as $termin){
        if(isset($_GET['termin']) && !strcmp($_GET['termin'], $termin->IDTermin))
            echo '<div class="row" style="background-color:rgba(255, 255, 255, 0.2);border-radius:5%;"><a href="' . $_SERVER['PHP_SELF'] . '?controller=korisnik&action=oceni&termin=' . $termin->IDTermin . '">';
        else
            echo '<div class="row"><a href="' . $_SERVER['PHP_SELF'] . '?controller=' . $ctrl .'&action=oceni&termin=' . $termin->IDTermin . '">';
                echo'<span class="naslov">' . $termin->naslov . '</span>';
                echo '<span class="vreme">' . (new DateTime($termin->datum))->format("H:i d-m-Y") . '</span>';
                echo '<span class="adresa">' . $termin->adresa . '</span>';
                echo '<span class="cena">' . $termin->cena . 'rsd</span>';
            echo '</a></div>';
    }

    echo'</div></div>';
?>

<?php

    echo '<div class="oceni">';
        echo '<div class="column ocene">';
            echo '<div class="title">';
                echo 'LISTA UCESNIKA' ;
            echo '</div>';
            echo '<div class="legenda">';
                echo '<span class="korisnik">KORISNICKO IME</span>';
                echo '<span class="ocena">OCENA</span>';
                echo '<span class="rank">RANK</span>';
            echo '</div>';
if(isset($_GET['termin'])){
    
    foreach($controller::$korisnici as $korisnik){
    
    $ocena = $korisnik->zbir_ocena == 0 ? 'NEOCENJEN' : bcadd($korisnik->zbir_ocena / $korisnik->broj_ocena, '0', 1);
    $grupa = '' . strcmp($korisnik->grupa, 'B') ? strcmp($korisnik->grupa, 'R') ? (strcmp($korisnik->grupa, 'V') ? 'ADMIN' : 'VIP') : 'KORISNIK' : 'BANOVAN';
            echo '<div class="row" onclick="openModal(\'' . $korisnik->username . '\')" id="'. $korisnik->username .'">';
                echo '<span class="korisnik">' . $korisnik->username . '</span>';
                echo '<span class="ocena">' . $ocena . '</span>';
                echo '<span class="rank">' . $grupa . '</span>';
            echo '</a></div>';
    }
}
?>
        
<?php
        
	echo '<div class="dugmad" id="modal_wrapper"><div id="modal_ocena">';
                echo '<h1 style="margin:0;padding:0;">Oceni korisnika: ' . '<span style="color: blue" id="kor"></span></h1>';
            echo '<div><br><br>';
                echo 'OCENA:&nbsp;&nbsp;';
		echo '<span id="z">';
                    echo '<span id="z1">&#9734;</span>';
                    echo '<span id="z2">&#9734;</span>';
                    echo '<span id="z3">&#9734;</span>';
                    echo'<span id="z4">&#9734;</span>';
                    echo '<span id="z5">&#9734;</span>';
		echo '</span>';
            echo '</div>';
            echo '<div>';
                echo 'RAZLOG:';
		echo '<textarea id="opis"></textarea>';
            echo '</div>';
            echo '<button type="button" onclick="checkOcena()">';
                echo 'OCENI KORISNIKA';
            echo '</button>';
            echo '<button type="button" onclick="closeModal()">';
                echo 'ZATVORI';
            echo '</button>';
	echo '</div></div>';

?>
        
    </div>
</div>
