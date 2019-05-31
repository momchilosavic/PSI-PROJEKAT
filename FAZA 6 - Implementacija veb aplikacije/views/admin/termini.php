<!DOCTYPE HTML>

<!--

File: termini.php
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
    <h3>Upravljaj terminima<hr></h3>
    <div class="row">
        <span class="column" style="width:15%">Naslov</span>
        <span class="column" style="width:15%">Adresa</span>
        <span class="column" style="width:10%">Vreme</span>
        <span class="column" style="width:20%">Opis</span>
        <span class="column" style="width:10%">Korisnik</span>
        <span class="column" style="width:10%">Ocena</span>
        <hr>
    </div>
    <?php
        require_once 'controllers/admincontroller.php';
        foreach(AdminController::$termini as $termin){
            $ocena = $termin->ocena;
            if($ocena == 0)
                $ocena = "NEOCENJEN";
            else 
                $ocena = bcadd($ocena, '0', 1);
            echo '<div class="row" style="padding: 1% 0; border-bottom: solid; border-width:0.1vw; border-color:grey">';
                echo '<span class="column" style="width:15%">';
                    echo $termin->naslov;
                echo '</span>';
                echo '<span class="column" style="width:15%">';
                    echo $termin->adresa;
                echo '</span>';
                echo '<span class="column" style="width:10%">';
                    echo (new DateTime($termin->datum))->format("H:i:s d.m.Y");
                echo '</span>';
                echo '<span class="column">';
                    echo $termin->opis;
                echo '</span>';
                echo '<span class="column" style="width:10%">';
                    echo $termin->username;
                echo '</span>';
                echo '<span class="column" style="width:10%">';
                    echo $ocena;
                echo '</span>';
                echo '<span class="column"  style="width:20%">';
                    echo '<a href="' . $_SERVER['PHP_SELF'] .'?controller=admin&action=obrisi_termin&termin=' . $termin->IDTermin
                            . '"><button>OBRISI</button></a>';
                echo '</span>';
            echo '</div>';
        }
    ?>
</section>