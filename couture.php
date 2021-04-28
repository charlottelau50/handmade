<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Homemade - Couture</title>
		<meta charset="UTF-8">
		<link href="style-3.css" rel="stylesheet">
	</head>

	<body>
		
		<?php
            		include('fil.php');
        	?> 
		
		<div class="titre-gd-h1">
			<h1>Couture</h1>
		</div>


		<div class="presentation-tuto">
			<div class="liste-tuto">
				<?php
					include("fonctionBD.php");
					$req=$bdd->query("SELECT tuto.idtuto, titreTuto, chemin FROM tuto, photo where theme='couture' AND tuto.idtuto=photo.idtuto");
					while($tuto=$req->fetch()){
						$compteur=1;
						$idtuto=$tuto['idtuto'];
						$image=$tuto['chemin'];
						$titretuto=$tuto['titreTuto'];
						echo "<div class='liste-tuto-.$compteur'>";
						echo "<p><a href='tuto.php?id=$idtuto'>$titretuto ";
						echo "<img src='image/$image'	alt='présentation'/></a></p>";
						$compteur++;
						echo "</div>";

					}
					

					
				?>
			
			</div>
		</div>
		
	
	<?php
            include('bas.php');
        ?> 
	
		
	</body>
</html>
