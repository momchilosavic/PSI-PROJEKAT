<!DOCTYPE HTML>

<!-- 

File: header.php
Author: Branislav Bajic 0599/2016

-->

<html>

<head>
	<style>
		section {
			padding: 50px;
		}
		.forma_reklame {
			font-size: 1.5vw;
        }

        .forma_reklame .field{
			width:100%;
			padding: 0.5% 1%;
			margin-bottom: 1%;
			box-sizing: border-box;
			font-size: 1vw;
        }

        .forma_reklame .dugme{
			-webkit-transition-duration: 0.4s; /* Safari */
			transition-duration: 0.4s;
			padding: 2%;
			font-size: 1vw;
        }

        .forma_reklame .dugme:hover{
			cursor: pointer;
		}
	</style>
</head>


<body>
	<section style="color: beige">
		<h4 style='color:red;'><?php if(isset($_POST['poruka'])) echo $_POST['poruka']; ?></h4>
		<form action="<?php echo $_SERVER['PHP_SELF'].'/?controller=vip&action=dodaj_reklamu';?>" method="post" name="reklame_forma" class="forma_reklame" enctype="multipart/form-data">
			Naziv:<br>
			<input class="field" type="text" value="" name="reklame_naziv">
			<br>
			Adresa:<br>
			<input class="field" type="text" value="" name="reklame_adresa">
			<br>
			Veb sajt:<br>
			<input class="field" type="text" value="" name="reklame_url">
			<br>
			Slika:
			<input class="field" type="file" value="Dodaj Sliku" name="reklame_slika">
			<br><br>
			<input class="dugme" type="submit" name="submit" value="Postavi">
			</form>
	</section>
</body>

</html>