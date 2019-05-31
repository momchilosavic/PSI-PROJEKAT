<!DOCTYPE HTML>

<!--
 
File: index.php
Author: Momcilo Savic

-->

<style>
    section {
    display:inline-block;
    color: beige;
    font-size: 1.1vw;
    width: 90%;
    display: block;
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
    section button{
	-webkit-transition-duration: 0.4s; /* Safari */
	transition-duration: 0.4s;
	padding: 2%;
	font-size: 1vw;
        width: 40%;
    }
    section button:hover{
            cursor: pointer;
    }
    section a{
        text-align: center;
        text-decoration: none;
        color: black;
        display:block;
        padding: 1% 5%;
    }
</style>

<section>
    <h3>Dobrodosli u Admin panel<hr></h3>
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=admin&action=upravljaj_korisnicima""><button>
            UPRAVLJAJ KORISNICIMA
    </button></a>
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=admin&action=upravljaj_terminima""><button>
            UPRAVLJAJ TERMINIMA
    </button></a>
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=admin&action=upravljaj_reklamama""><button>
            UPRAVLJAJ REKLAMAMA
    </button></a>
</section>
