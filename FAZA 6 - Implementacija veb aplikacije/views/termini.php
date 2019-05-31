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
    .ponuda{
        width: 100%;
        display:block;
        color: white;
        font-size: 0.75vw;
    }
    .ponuda h1, .ponuda button{
        display: inline-block;
    }
    .ponuda h1{
        width:80%;
    }
    .ponuda button{
        width: 20%;
    }
    #modal_wrapper{
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.8); /* Black w/ opacity */
        -webkit-animation-name: fadeIn; /* Fade in the background */
        -webkit-animation-duration: 0.4s;
        animation-name: fadeIn;
        animation-duration: 0.4s
    }
    #modal_ocena{
        padding:1% 5%;
        box-sizing: border-box;
        position: fixed;
        background-color: #eeeeee;
        width: 50%;
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
        border-radius: 1vw;
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
      .forma_termin{
	font-size: 1.5vw;
}

.forma_termin textarea{
	height: 20%;
	width: 100%;
	font-size: 1vw;
}

.forma_termin input{
	width:100%;
	padding: 0.5% 1%;
	margin-bottom: 1%;
	box-sizing: border-box;
	font-size: 1vw;
}

.forma_termin button{
	-webkit-transition-duration: 0.4s; /* Safari */
	transition-duration: 0.4s;
	padding: 2%;
	font-size: 1vw;
}

.forma_termin button:hover{
	cursor: pointer;
}
</style>

<script>
     function openModal(sport){
        document.getElementById("modal_wrapper").style.display = "block";
        document.getElementById("sport").textContent = 'Kreiraj termin za ' + sport;
    }
    
    function closeModal(){
        document.getElementById("modal_wrapper").style.display="none";
    }
    
    function checkForm(sport){
    var greska = false;
	
	var i;
	for (i = 0; i < inputs.length; i++) { 
		if(inputs[i].value == ""){
			greska = true;
			inputs[i].style.border = "thin solid red";
		}
	}
        if(!greska){
            var now = new Date();
            var date = new Date(inputs[2].value);
            var nextYear = new Date(new Date().setFullYear(new Date().getFullYear() + 1));
            if(date < now || date >= nextYear){
                greska = true;
                inputs[2].style.border = "thin solid red";
            }
            datum = date.toString();
            datum = datum.split(' ');
            mesec = ("JanFebMarAprMayJunJulAugSepOctNovDec".indexOf("" + datum[1]) / 3 + 1 );
            mesec = (parseInt(mesec) < 10) ? '0' + mesec : mesec;
            datum = '' + datum[3] + '-' + mesec + '-' + datum[2] + ' ' + datum[4];
            if(isNaN(inputs[3].value)){
                greska = true;
                inputs[3].style.border = "thin solid red";
            }
            if(isNaN(inputs[4].value)){
                greska = true;
                inputs[4].style.border = "thin solid red";
            }
        }
	if(!greska){
            if(opis.value === ''){
                opis = ' ';
            }
            else
                opis = opis.value;
            url = window.location.href;
            url = url.split('&action=');
            window.location.replace('' + url[0] + '&action=napravi&naslov=' + inputs[0].value + '&adresa=' + inputs[1].value + 
                    '&datum=' + datum + '&cena=' + inputs[3].value + '&broj_potrebnih_igraca=' + inputs[4].value + 
                    '&opis=' + opis + '&sport=' + sport);
	}
    }
    window.onload=function(){
	inputs = document.getElementsByTagName("input");
	
	inputs[0].addEventListener("keyup", turnOffWarning_0);
	inputs[1].addEventListener("keyup", turnOffWarning_1);
	inputs[2].addEventListener("change", turnOffWarning_2);
	inputs[3].addEventListener("keyup", turnOffWarning_3);
	inputs[4].addEventListener("keyup", turnOffWarning_4);
	opis=document.getElementsByTagName("textarea")[0];
}
function turnOffWarning_0(){
	inputs[0].style.border="thin solid gray";
}

function turnOffWarning_1(){
	inputs[1].style.border="thin solid gray";
}

function turnOffWarning_2(){
	inputs[2].style.border="thin solid gray";
}

function turnOffWarning_3(){
	inputs[3].style.border="thin solid gray";
}

function turnOffWarning_4(){
	inputs[4].style.border="thin solid gray";
}

</script>

<div class="termini">
    <p style="font-size:1.5vw; color:white; padding: 0 5%; margin: 0; margin-bottom: 2%;">
        <?php echo '' . ucfirst($_POST['sport']); ?>
    <hr>
    </p>
    
    <div class="ponuda">
        <h1>Imas prostor, ali nemas igrace? Ponudi termin i napravi ekipu!</h1><!--
     --><button onclick="openModal('<?php echo $_GET['action']; ?>')">Ponudi svoj termin</button>
        <hr>
    </div>
    
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
                    if(isset($_POST['sport']) && strcmp($_POST['sport'], 'termini u kojima ucestvujes')){
                        echo '<div class ="b"><button type="button"><a href="' .  $_SERVER['PHP_SELF'] . 
                                '?controller=korisnik&action=prijavise&termin=' . $termin->IDTermin . '">POSALJI ZAHTEV</a></button></div>';
                    }
                echo '</div>';
            echo '</div>';
        echo '</div>';	
    } 
    
    
echo '</div>';

?>
    <div id="modal_wrapper">
        <div id="modal_ocena">
            <form class="forma_termin" action="">
                <h4 id='sport'></h4><hr>
		Naslov:<br>
		<input type="text" value="">
		<br>
		Adresa:<br>
		<input type="text" value="">
		<br>
		Datum i vreme:<br>
                <input type="datetime-local" value="">
		<br>
		Cena:<br>
		<input type="text" value="">
		<br>
		Broj ucesnika:<br>
		<input type="text" value="">
		<br>
		Opis:<br>
		<textarea></textarea>
		<br>
		<br>
		<button type="button" id="finish" onclick='checkForm("<?php echo $_GET['action']; ?>")'>
		Zavrsi kreiranje
		</button>
                <button type="button" id="back" onclick='closeModal()'>
                    Nazad
		</button>
            </form> 	
        </div>
    </div>