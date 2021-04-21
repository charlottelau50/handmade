<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Homemade</title>
		<meta charset="UTF-8">
		<link href="style-3.css" rel="stylesheet">
	</head>

	<body>
	
		<?php
		include('fil.php');
		?>
		
		<div class="explication">
			<p class="texte-explication">
			<p class="texte-explication-1">
				Nos tutos ont été pensés et créés par nous-mêmes pour vous ! Suivez-les puis partagez avec nous vos créations et vos suggestions ...
			<p class="texte-explication-3"> </p>
			<p class="texte-explication-2"><a href="connexion.html"> Se connecter &#8594;</a> </p> 
			</p>
		</div>
		
		<div class="prefere">
			<p class="titre-prefere">BESTSELLERS</p>
			<div class="bestsellers">
				<div class="pref-1"><p><a href="sac.html"><img src="image/carré-sac.jpg" alt="pref-1"/></a></p></div>
				<div class="pref-2"><p><a href="sac.html"><img src="image/carré-toile.jpg" alt="pref-2"/></a></p></div>
				<div class="pref-3"><p><a href="sac.html"><img src="image/carré-compote.jpg" alt="pref-3"/></a></p></div>
				<div class="pref-4"><p><a href="sac.html"><img src="image/carré-sac.jpg" alt="pref-4"/></a></p></div>
				<div class="pref-5"><p><a href="sac.html"><img src="image/carré-sac.jpg" alt="pref-5"/></a></p></div>
			</div>
		</div>
		
		<div class="pageaccueil-inscription">
			<div class="inscription-texte-1">Inscrivez-vous ! </div>
			<div class="inscription-texte-2">Pour avoir accès à des offres exclusives </div>
			<div class="inscription-cliquer"><a href="inscription.html"> Cliquez ici &#8594; </a></div>
		</div>
		
		<div class="pageaccueil">
			<p class="titre-prefere">VOIR TOUT</p>
			<div class="pageaccueil-ligne1">
				<div class="couture">
					<p><a href="couture.html"> 
						<img src="image/accueil-couture.jpg" alt="présentation"/>
					</a></p>
				</div>
				<div class="décoration">
					<p><a href="decoration.html"> 
						<img src="image/accueil-decoration.jpg" alt="présentation"/>
					</a></p>
				</div>
				<div class="cuisine">
					<p><a href="cuisine.html"> 
						<img src="image/accueil-cuisine.jpg" alt="présentation"/>
					</a></p>
				</div>
			</div>
			<div class="pageaccueil-ligne2">
				<div class="cosmetique">
					<p><a href="cosmetique.html"> 
						<img src="image/accueil-cosmetique.jpg" alt="présentation"/>
					</a></p>
				</div>
				<div class="produits-menagers">
					<p><a href="prod-menagers.html"> 
						<img src="image/accueil-menagers.jpg" alt="présentation"/>
					</a></p>
				</div>
			</div>
		</div>

	
		<?php
		include('bas.php');
		?>
	</body>
</html>
