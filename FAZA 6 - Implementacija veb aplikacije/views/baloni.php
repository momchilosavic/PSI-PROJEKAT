
<!DOCTYPE HTML>

<!--

File: baloni.php
Author: Branislav Bajic

-->

<style>
    aside{
        display:inline-block;
        color: beige;
        font-size: 1.1vw;
        width: 20%;
        height:100%;
        box-sizing: border-box;
        margin-left: 2.5%;
        float:right;
        margin-right: 2.5%;
        position: absolute;
    }
    * {
        box-sizing: border-box
    }
    .mySlides1, .mySlides2 {
        display: none
    }
    .slideshow-container img {
        vertical-align: middle;
        position:relative;
        background-position: 50% 50%;
        background-repeat:   no-repeat;
        background-size:     cover;
        height: 10vw;
    }
    /* Slideshow container */
    .slideshow-container {
      max-width: 1000px;
      margin: auto;
      position: relative;
      padding: 5% 0;
    }
    /* Next & previous buttons */
    .prev, .next {
      cursor: pointer;
      position: absolute;
      top: 40%;
      width: auto;
      padding: 3%;
      margin-top: -5%;
      color: white;
      font-weight: bold;
      font-size: 1.5vw;
      transition: 0.6s ease;
      border-radius: 0 3px 3px 0; 
      user-select: none;
    }
    /* Position the "next button" to the right */
    .next {
      right: 0;
      border-radius: 3px 0 0 3px;
    }
    /* On hover, add a grey background color */
    .prev:hover, .next:hover {
      background-color: #f1f1f1;
      color: black;
    }
</style>
<aside>
    <h2 style="text-align:center">Prijateljski sportski objekti</h2>
    <hr>
    <div class="slideshow-container">
<?php
    if(isset($_GET['controller']) && !empty($_GET['controller']))
        $controller = $_GET['controller'];
    else
        $controller = 'gost';
require_once 'controllers/' . $controller . 'controller.php';
switch($controller){
    case 'gost': $controller = 'GostController'; break;
    case 'korisnik': $controller = 'KorisnikController'; break;
    case 'vip': $controller = 'VIPController'; break;
    case 'admin': $controller = 'AdminController'; break;
    
}

        shuffle($controller::$baloni);
        foreach($controller::$baloni as $balon){
                echo '<div class="mySlides1">';
                    echo '<img src="\TrebaMiIgrac\views\reklame\\' . $balon->slika . '" style="width:100%">';
                    echo '<div>' . $balon->naziv . '</div>';
                    echo '<div>' . $balon->adresa . '</div>';
                    echo '<div>' . $balon->veb_sajt . '</div>';
                echo '</div>';
        }
?>

        <a class="prev" onclick="plusSlides(-1, 0)">&#10094;</a>
        <a class="next" onclick="plusSlides(1, 0)">&#10095;</a>
    </div>
    <div class="slideshow-container">
<?php
        shuffle($controller::$baloni);
        foreach($controller::$baloni as $balon){
                echo '<div class="mySlides2">';
                    echo '<img src="\TrebaMiIgrac\views\reklame\\' . $balon->slika . '" style="width:100%">';
                    echo '<div>' . $balon->naziv . '</div>';
                    echo '<div>' . $balon->adresa . '</div>';
                    echo '<div>' . $balon->veb_sajt . '</div>';
                echo '</div>';
        }
?>
      <a class="prev" onclick="plusSlides(-1, 1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1, 1)">&#10095;</a>
    </div>
         
    <script>
        var slideIndex = [1,1];
        var slideId = ["mySlides1", "mySlides2"];
        showSlides(1, 0);
        showSlides(1, 1);

        function plusSlides(n, no) {
          showSlides(slideIndex[no] += n, no);
        }

        function showSlides(n, no) {
          var i;
          var x = document.getElementsByClassName(slideId[no]);
          if (n > x.length) {slideIndex[no] = 1;}    
          if (n < 1) {slideIndex[no] = x.length;}
          for (i = 0; i < x.length; i++) {
             x[i].style.display = "none";  
          }
          x[slideIndex[no]-1].style.display = "block";  
        }
        
        setInterval(function(){
            carousel(0);
            carousel(1);
        }, 2500);
        function carousel(no) {
            var i;
            var x = document.getElementsByClassName(slideId[no]);
            slideIndex[no] += 1;
            if (slideIndex[no] > x.length) {slideIndex[no] = 1;}         
            for (i = 0; i < x.length; i++) {
              x[i].style.display = "none";  
            } 
            x[slideIndex[no]-1].style.display = "block";
          }
        </script>                
</aside>