<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Homemade - Décoration</title>
		<meta charset="UTF-8">
		<link href="style-3.css" rel="stylesheet">
	</head>

	<body>
	
	<div class="titre1">
		<img class="titre" src="image/titre-3.jpg" alt="titre"/>
	</div>
	
	<div class="fil">
			<div class="categorie">
				<a  href="projet.html">Accueil</a>
			</div>
			<div class="categorie"> 
				<a href="couture.html">Couture</a>
				<div class="diy">
					<p class="lien"><a href="couvercle.html">Couvercle</a></p>
					<p class="lien"><a href="chouchou.html">Chouchou</a></p>
				</div>
			</div>
			<div class="categorie"> 
				<a href="decoration.html">Décoration</a>
				<div class="diy">
					<p class="lien"><a href="toile.html" >Toile</a></p>
					<p class="lien"><a href="calendrier.html" >Semainier</a></p>
					<p class="lien"><a href="Bougie.html">Bougie</a></p>
				</div>
			</div>
			<div class="categorie">
				<a  href="forum.html">A votre tour!</a>
			</div>
		</div>
		
		<div class="titre-gd-h1">
			<h1>Décoration</h1>
		</div>

		
		<div class="couture">
			<img src="image/handmade.jpg" class="imgcategorie" alt="img-deco">
		</div>
		
		<div class="presentation-tuto">
			<div class="liste-tuto">
				<?php
					include("fonctionBD.php");
					$req=$bdd->query("SELECT tuto.idtuto, titreTuto, chemin FROM tuto, photo where theme='decoration' AND tuto.idtuto=photo.idtuto");
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
	
	<div id="couleur-3-bas-page">
		<div id="bas-page">
			<div class="colonne-1">
				<p><a  href="projet.html">Accueil</a></p>
				<p><a href="couture.html">Couture</a></p>
				<p><a href="decoration.html">Décoration</a></p>
				<p><a  href="forum.html">A votre tour!</a></p>
			</div>
			<div class="colonne-2">
				<p><a href="inscription.html">S'inscrire</a></p>
				<p><a href="connexion.html">Se connecter</a></p>
			</div>
			<div class="colonne-3">
				<p><a  href="credit.html">Crédits</a></p>
			</div>
		</div>
	</div>
	
	<div class="titre1">
		<img class="titre-fin" src="image/titre-3.jpg" alt="titre"/>
	</div>
	
		
	</body>
</html>
