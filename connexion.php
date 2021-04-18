<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=projet', 'root', '');
if(isset($_POST['connexion'])) {
   $mailconnect = htmlspecialchars($_POST['identifiant']);
   $mdpconnect = htmlspecialchars($_POST['mdp']);
   if(!empty($mailconnect) AND !empty($mdpconnect)) {

      $mdpconnect = crypt($mdpconnect, '$6$rounds=5000$14ecoaj87enek720LEPuy62m3h5FedXa$');
      $requser = $bdd->prepare("SELECT * FROM utilisateur WHERE email = ? AND mdp = ?");
      $requser->execute(array($mailconnect,$mdpconnect));
      $userexist = $requser->rowCount();
      echo $userexist;
      if($userexist == 1) {
        echo "vous etes connecter";
         $userinfo = $requser->fetch();
         $_SESSION['id'] = $userinfo['idutilisateur'];
         $_SESSION['pseudo'] = $userinfo['pseudo'];
         $_SESSION['mail'] = $userinfo['email'];
         header("Location: projet.php");
      } else {
         $erreur = "Mauvais mail ou mot de passe !";
         
      }
   } else {
       $erreur = "Tous les champs doivent être complétés !";
      
   }
}
?>



<!DOCTYPE html>
<html lang="fr">
	<head>
	<title>Connexion</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" media="all" href="style-3.css">
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
						<p class="lien"> <a href="calendrier.html"> Semainier</a></p>
						<p class="lien"><a href="Bougie.html">Bougie</a></p>
					</div>		
				</div>
				<div class="categorie">
					<a  href="forum.html">A votre tour!</a>
				</div>
		</div>
		
		<div class="acceuil">
		<div class="titre-gd-h1">
			<h1>Se connecter</h1>
		</div>
            <h2> Pas encore de compte? <a href='inscription2.php'>inscrivez vous !</a></h2>
		<form method="post" action="connexion.php">
			<label>
				Adresse-mail : 
			</label>
			<input type="email" id="identifiant" name="identifiant" required>
			<br/>
			<label>
				Mot de passe : 
			</label>
			<input type="password" id="mdp" name="mdp" required>
			<br/>
			<a href="RecuperationMDP.html">
				Mot de passe oublié ?
			</a>
			<br/>
			<input type="submit" name="connexion" value=" Se Connecter">
            <?php
         if(isset($erreur)) {
            echo $erreur;
         }
         ?>
		</form>

        

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
