<!DOCTYPE html>
<html lang="fr">
	<head>
	<title>Inscription</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" media="all" href="style-3.css">
	</head>
	
	<body>
    <?php
        $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');

        if(!empty($_POST)){
            extract($_POST);
            $valid = (boolean) true;

            if(isset($_POST['inscription'])){
                $pseudo = (String) trim($pseudo);
                $email = (String) strtolower(trim($email));
                $mdp = (String) trim($mdp);
                $nom = (String) trim($nom);
                $prenom = (String) trim($prenom);

                if(empty($pseudo)){
                    $valid = false;
                    $err_pseudo = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs !</p>";
                }else{
                    $req = $bdd->prepare("SELECT idutilisateur FROM utilisateur WHERE pseudo = ?"); 
                    $req->execute(array($pseudo)); 
                    $utilisateur = $req->fetch();
                    if(isset($utilisateur['idutilisateur'])){
                        $valid = false;
                        $err_pseudo = "<p style=\"color:#FF0000\";>Ce pseudo existe déjà !</p>";
                    }
                }

                if(empty($email)){
                    $valid = false;
                    $err_email = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs !</p>";
                }else{
                    $req = $bdd->prepare("SELECT idutilisateur FROM utilisateur WHERE mail = ?"); 
                    $req->execute(array($mail)); 
                    $utilisateur = $req->fetch();
                    if(isset($utilisateur['idutilisateur'])){
                        $valid = false;
                        $err_mail = "<p style=\"color:#FF0000\";>Ce mail existe déjà !</p>";
                    }
                }

                if(empty($mdp)){
                    $valid = false;
                    $err_mdp = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs !</p>";
                }
                if(empty($mdp2)){
                    $valid = false;
                    $err_mdp2 = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs !</p>";
                }
                if($mdp2!=$mdp){
                    $valid=false;
                    $err_mdp2="<p style=\"color:#FF0000\";>vos mots de passe doivent etre identique!</p>";
                }

                if(empty($nom)){
                    $valid = false;
                    $err_nom = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs !</p>";
                }

                if(empty($prenom)){
                    $valid = false;
                    $err_prenom = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs !</p>";
                }

                if(empty($theme)){
                    $valid = false;
                    $err_theme = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs !</p>";
                }

                if(empty($datenaissance)){
                    $valid = false;
                    $err_datenaissance = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs !</p>";
                }

                if($valid){
                    $mdp = crypt($mdp, '$6$rounds=5000$14ecoaj87enek720LEPuy62m3h5FedXa$');
                    $req = $bdd->prepare("INSERT INTO utilisateur (themeFavorie, nom, prenom,email,mdp,pseudo,datenaissance) VALUES (?, ?, ?, ?, ?,?,?)");
                    $req->execute(array($theme, $nom, $prenom, $email, $mdp,$pseudo,$datenaissance));
                    header('Location: inscription2.html'); 
                    exit;
                }
            }
        }
    ?>


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
			<h1>Inscription</h1>
		</div>
		
		<p>Vous avez déjà un compte?<a href="connexion.php">Connectez-vous ! </a></p>

		<form method="post" action="inscription2.php">
        
            <p>
                <label>
                    Nom : 
                </label>
            <?php
                if(isset($err_nom)){
                    echo $err_nom;
                }
            ?>
			    <input type="text" id="nom" name="nom" placeholder="Dupont" pattern="[a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ-]+" required>
            </p>
			
            <p>
                <label>
                    Prénom : 
                </label>
            <?php
                if(isset($err_prenom)){
                    echo  $err_prenom;
                }
            ?>
                <input type="text" id="prenom" name="prenom" placeholder="José" pattern="[a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ-]+" required>
			</p>

            <?php
                if(isset($err_datenaissance)){
                    echo $err_datenaissance;
                }
            ?>
                <input type="date" name="datenaissance">
                    <libellé>date de naissance</libellé>
                    </input>
			</p>
            

            
            <p>
                <label>
                    Adresse mail :
                </label>
            <?php
                if(isset($err_email)){
                    echo $err_email;
                }
            ?>
			<input type="email" id="email" name="email" placeholder="XXX@XXX.XXX">
			</p>

            <p>
                <label>
                    Pseudo : 
                </label>
            <?php
                if(isset($err_pseudo)){
                    echo $err_pseudo;
                }
            ?>
			<input type="text" id="pseudo" name="pseudo" pattern="[a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ-]+" >
			</p>

            <p>
                <label>
                    Mot de passe :
                </label>
            <?php
                if(isset($err_mdp)){
                    echo $err_mdp;
                }
            ?>
			<input type="password" id="mdp" name="mdp" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}">
			</p>

            <p>
                <label>
                    Confirmez votre mot de passe :
                </label>
            <?php
                if(isset($err_mdp2)){
                    echo $err_mdp2;
                }
            ?>
			<input type="password" id="mdp2" name="mdp2">
		</p>
            <p>
                <label>
                    Qu'elle est votre theme favori :
                </label>
            <?php
                if(isset($err_theme)){
                    echo $err_theme;
                }
            ?>
                <select name='theme'>
                    <option value='couture'>Couture </option>
		    <option value='decoration'>decoration </option>
		    <option value='cosmetique'>Cosmetique</option>
		    <option value='cuisine'>Cuisine </option>
		    <option value='produit_menager'>produit menager </option>
                </select>
            </p>

			<input type="submit" value="Valider" name="inscription">

		</form>
		</div>

		<div id="couleur-3-bas-page">
			<div id="bas-page">
				<div class="colonne-1">
					<p><a  href="projet.html">Accueil</a></p>
					<p><a href="couture.html">Couture</a></p>
					<p><a href="decoration">Décoration</a></p>
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
