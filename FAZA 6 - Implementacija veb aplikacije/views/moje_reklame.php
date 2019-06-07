<!DOCTYPE HTML>

<!-- 

File: header.php
Author: Branislav Bajic 0599/2016

-->

<html>
	
<head>

	<style>
		section {
			color: beige;
			font-size: 1.5vw; 
			padding: 50px;
		}
		
		a {
			color: cornflowerblue;
		}
	</style>

</head>
	
<body>

	<section>
		
		<p>Uspešno ste postavili svoju reklamu:</p>
		
		<?php
			$balon = null;
			if($_SESSION['group'] == 'V'){
				require_once 'controllers/vipcontroller.php';
				$balon = VIPController::$baloni;
			}
			if($_SESSION['group'] == 'A'){
				require_once 'controllers/admincontroller.php';
				$balon = AdminController::$baloni;
			}
			
			echo '<img height="50%" width="50%" src="/TrebaMiIgrac/views/reklame/'. $balon[0]->slika .'"/>';
			echo '<p><strong style="color: #4CAF50";>Naziv objekta:</strong> '. $balon[0]->naziv .'</p>';
			echo '<p><strong style="color: #4CAF50">Adresa:</strong> '. $balon[0]->adresa .'</p>';
			echo '<p><strong style="color: #4CAF50";>Sajt:</strong> <a href=".'. $balon[0]->naziv .'">'. $balon[0]->veb_sajt .'</a></p>';
			
		?>
		
		
		
	</section>
	
</body>
	
</html>