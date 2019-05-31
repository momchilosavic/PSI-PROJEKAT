<!DOCTYPE HTML>

<!-- 

File: header.php
Author: Branislav Bajic 

-->

<html>
    <head>
        <meta charset="UTF-8" />
        <title>TrebaMiIgrac.rs</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <style>
            header{
                width:100%;
                overflow:hidden;
                margin:0;
                padding:0;
                display: block;
            }
            header img{
                display:block;
                width:100%;
                margin-bottom: -15%;
            }
            .topnav {
                -webkit-box-shadow: 5px 5px 10px 5px rgba(0,0,0,0.6);
                -moz-box-shadow: 5px 5px 10px 5px rgba(0,0,0,0.6);
                box-shadow: 5px 5px 10px 5px rgba(0,0,0,0.6);
                background-color: #333;
                overflow: hidden;
                margin-bottom: 1%;
            }
            .topnav a {
              float: left;
              display: block;
              color: #f2f2f2;
              text-align: center;
              padding: 14px 16px;
              text-decoration: none;
              font-size: 17px;
            }
            .active {
              background-color: #4CAF50;
              color: white;
            }
            .topnav .icon {
              display: none;
            }
            .dropdown {
              float: left;
              overflow: hidden;
            }
            .dropdown .dropbtn {
              font-size: 17px; 
              border: none;
              outline: none;
              color: white;
              padding: 14px 16px;
              background-color: inherit;
              font-family: inherit;
              margin: 0;
            }
            .dropdown-content {
              display: none;
              position: absolute;
              background-color: #f9f9f9;
              min-width: 160px;
              box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
              z-index: 1;
            }
            .dropdown-content a {
              float: none;
              color: black;
              padding: 12px 16px;
              text-decoration: none;
              display: block;
              text-align: left;
            }
            .topnav a:hover, .dropdown:hover .dropbtn {
              background-color: #555;
              color: white;
            }
            .dropdown-content a:hover {
              background-color: #ddd;
              color: black;
            }
            .dropdown:hover .dropdown-content {
              display: block;
            }
            @media screen and (max-width: 600px) {
              .topnav a:not(:first-child), .dropdown .dropbtn {
                display: none;
              }
              .topnav a.icon {
                float: right;
                display: block;
              }
            }
            @media screen and (max-width: 600px) {
              .topnav.responsive {position: relative;}
              .topnav.responsive a.icon {
                position: absolute;
                right: 0;
                top: 0;
              }
              .topnav.responsive a {
                float: none;
                display: block;
                text-align: left;
              }
              .topnav.responsive .dropdown {float: none;}
              .topnav.responsive .dropdown-content {position: relative;}
              .topnav.responsive .dropdown .dropbtn {
                display: block;
                width: 100%;
                text-align: left;
              }
            }
            wrapper{
                background: linear-gradient(180deg,#333, #223);
                width: 100%;
                display: block;
                box-sizing: border-box;
                min-height: 40vw;
                padding-bottom: 2%;
            }
        </style>
    </head>
    <body style='overflow-x:hidden'>            
        <header>
            <img src="\TrebaMiIgrac\views\baner.jpg" />
        </header>
            
        <div class="topnav" id="myTopnav">
            <a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=korisnik&action=index">Pocetna</a>
            <div class="dropdown">
                <button class="dropbtn">Termini 
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=korisnik&action=fudbal">Fudbal</a>
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=korisnik&action=kosarka">Kosarka</a>
                </div>
            </div> 
            <a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=korisnik&action=pravilnik">Pravilnik</a>
            <div class="dropdown active" style="float:right;">
                <button class="dropbtn"><?php echo '' . $_SESSION['username']; ?>
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content" style="right:0">
                    <p style="color: black; text-align: center;border-bottom: solid;font-style: italic">Ocena: <?php require_once 'controllers/korisnikcontroller.php'; echo KorisnikController::dohvatiOcenu(); ?></p>
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=korisnik&action=termini">Moji termini</a>
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=korisnik&action=obavestenja">Zahtevi</a>
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=korisnik&action=oceni">Oceni korisnike</a>
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=korisnik&action=logout">Odjavi se</a>
                </div>
            </div> 
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
        </div>
    
    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>
    
    <wrapper>