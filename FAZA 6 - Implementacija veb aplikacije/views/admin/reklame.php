<!DOCTYPE HTML>

<!--

File: reklame.php
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
</style>

<section>
    <h3>Upravljaj reklamama<hr></h3>
    <div class="row">
        <span class="column" style="width:20%">Naziv</span>
        <span class="column" style="width:20%">Adresa</span>
        <span class="column" style="width:15%">Veb sajt</span>
        <span class="column" style="width:15%">Korisnik</span>
        <span class="column" style="width:10%">Datum</span>
        <hr>
    </div>
    <?php
        require_once 'controllers/admincontroller.php';
        foreach(AdminController::$baloni as $balon){
            echo '<div class="row" style="padding: 1% 0; border-bottom: solid; border-width:0.1vw; border-color:grey">';
                echo '<span class="column" style="width:20%">';
                    echo $balon->naziv;
                echo '</span>';
                echo '<span class="column" style="width:20%">';
                    echo $balon->adresa;
                echo '</span>';
                echo '<span class="column" style="width:15%">';
                    echo $balon->veb_sajt;
                echo '</span>';
                echo '<span class="column" style="width:15%">';
                    echo $balon->username;
                echo '</span>';
                echo '<span class="column" style="width:10%">';
                    echo (new DateTime($balon->datum_reklamiranja))->format("d.m.Y");
                echo '</span>';
                echo '<span class="column"  style="width:20%">';
                    echo '<a href="' . $_SERVER['PHP_SELF'] .'?controller=admin&action=obrisi_reklamu&reklama=' . $balon->IDObjekat
                            . '"><button>OBRISI</button></a>';
                echo '</span>';
            echo '</div>';
        }
    ?>
</section>