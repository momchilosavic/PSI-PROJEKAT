<!DOCTYPE HTML>

<!--

File: korisnici.php
Autor: Momcilo Savic

-->

<style>
    section {
    display:inline-block;
    color: beige;
    font-size: 1.1vw;
    width: 100%;
    box-sizing: border-box;
    }
    section h3{
        padding: 1% 10%;
    }
    section content {
        display: flex;
    }
    section content div{
        flex: 1;
        margin: 1%;
        overflow: hidden;
        background-size: cover;
        background-position: center;
    }
    section content img{
        width:100%;
    }
    section button, #modal_ocena button{
	-webkit-transition-duration: 0.4s; /* Safari */
	transition-duration: 0.4s;
	padding: 2%;
	font-size: 1vw;
        width: 40%;
    }
    section button:hover, #modal_ocena button:hover{
            cursor: pointer;
    }
    section a{
        text-align: center;
        text-decoration: none;
        color: black;
        display:block;
        padding: 1% 5%;
    }
    .row{
        width: 80%;
        margin: auto;
        min-height: 2vw;
        display:block;
        color:white;
        box-sizing: border-box;
    }
    .column{
        display: inline-block;
        width: 20%;
        text-align: left;
        box-sizing: border-box;
    }
    .column button{
        width: 50%;
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
        width: 75%;
        height: 90%;
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
    #modal_ocena button{
        bottom: 0;
        position: absolute;
        left: 0;
        right: 0;
        margin: 5% 5%;
    }
    #wrapper_o{
        display: block;
        overflow-y:scroll;
        height: 15vw;
        border-bottom: solid;
        border-left: solid;
        border-width: 0.1vw;
        padding: 5% 0;
    }
</style>

<script>
    function openModal(username){
        document.getElementById("modal_wrapper").style.display = "block";
        document.getElementById("korisnik").textContent = 'Ocene korisnika ' + username;
        url = window.location.href;
        window.location.assign(url + "&korisnik=" + username);
    }
    
    function closeModal(){
        document.getElementById("modal_wrapper").style.display="none";
        url = window.location.href.split("&korisnik")[0];
        window.location.replace(url);
        
    }
</script>

<section>
    <h3>Upravljaj korisnicima<hr></h3>
    <div class="row">
        <span class="column">Korisnicko ime</span>
        <span class="column" style="width:10%">Ocena</span>
        <span class="column" style="width:10%">Rank</span><hr>
    </div>
    <?php
        require_once 'controllers/admincontroller.php';
        AdminController::dohvatiSveKorisnike();
        foreach(AdminController::$korisnici as $korisnik){
            $ocena = $korisnik->zbir_ocena;
            if($ocena == 0)
                $ocena = "NEOCENJEN";
            else 
                $ocena = bcdiv($ocena, $korisnik->broj_ocena, 1);
            echo '<div class="row">';
                echo '<span class="column">';
                    echo $korisnik->username;
                echo '</span>';
                echo '<span class="column" style="width:10%">';
                    echo '' . $ocena;
                echo '</span>';
                echo '<span class="column" style="width:10%">';
                    echo '' . $korisnik->grupa;
                echo '</span>';
                if(strcmp($korisnik->grupa, 'B'))
                    echo '<span class="column"><a href ="' . $_SERVER['PHP_SELF'] .'?controller=admin&action=banuj&korisnik=' 
                            . $korisnik->username . '"><button>BAN</button></a></span>';
                else
                    echo '<span class="column"><a href ="' . $_SERVER['PHP_SELF'] .'?controller=admin&action=odbanuj&korisnik=' 
                            . $korisnik->username . '"><button>UNBAN</button></a></span>';
                if(!strcmp($korisnik->grupa, 'R'))
                    echo '<span class="column"><a href ="' . $_SERVER['PHP_SELF'] .'?controller=admin&action=unapredi&korisnik=' 
                            . $korisnik->username . '"><button>UNAPREDI</button></a></span>';
                else if(!strcmp($korisnik->grupa, 'V'))
                    echo '<span class="column"><a href ="' . $_SERVER['PHP_SELF'] .'?controller=admin&action=degradiraj&korisnik=' 
                            . $korisnik->username . '"><button>DEGRADIRAJ</button></a></span>';
                else
                    echo '<span class="column"></span>';
                echo '<span class="column"><button onclick="openModal(\'' . $korisnik->username . '\')">'
                            . 'OCENE</button></span>';
            echo '</div>';
        }
    ?>
</section>

<div id="modal_wrapper"<?php if(isset($_GET['korisnik'])) echo 'style="display:block"';?>>
    <div id="modal_ocena">
            
        <h4 id='korisnik'>Ocene korisnika <?php echo $_GET['korisnik']; ?></h4><hr>
        <div class="row" style="color:black" id="ocene">
            <span class="column">Ocenjivac</span>
            <span class="column" style="width:10%">Termin</span>
            <span class="column" style="width:10%">Ocena</span>
            <span class="column" style="width:50%">Razlog</span><hr>
        </div>
        <div id="wrapper_o">
        <?php
            if(isset($_GET['korisnik'])){
                require_once 'controllers/admincontroller.php';
                AdminController::dohvatiSveOcene();
                foreach(AdminController::$ocena as $ocena){
                    echo '<div class="row" style="color:black">';
                        echo '<span class="column">' . $ocena->username_ocenjivac . '</span>';
                        echo '<span class="column" style="width:10%">' . $ocena->IDTermin .'</span>';
                        echo '<span class="column" style="width:10%">' . $ocena->ocena .'</span>';
                        echo '<span class="column" style="width:60%">' . $ocena->razlog .'</span><hr>';
                    echo '</div>';
                }
            }?>
        </div>
        <button type="button" id="back" onclick='closeModal()'>
            Nazad
	</button>
    </div>
    
</div>