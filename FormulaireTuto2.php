
<?php
include 'fil.php';
session_start();

//traitement des donnes du formulaire en php pour rentré des tutos dans la base 
/*
 il faut qu'on decide ou cette page seras accesible directement sur lacceuil ou dans le fil ou dans profil 
*/



try
{
	$bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

//on recupere l'idantifiant de l'utilisateur
if(isset($_SESSION['id']) AND $_SESSION['id'] > 0) {
   $getid = intval($_SESSION['id']);
}

//les fonctions

function inseretape($TexteEtape,$tuto,$photo){
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
    $ajout=$bdd->prepare("INSERT INTO etape(texte,idtuto,idphoto) VALUES(?,?,?)");
    $ajout->execute(array($TexteEtape,$tuto,$photo));
    $ajout->closecursor();
}

function inserphoto($chemin){
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
    $ajout=$bdd->prepare("INSERT INTO photo(datePhoto,chemin) VALUES(?,?)");
    $ajout->execute(array(date("Y-m-d"),$chemin));
    $ajout->closecursor();
}

function extraireidphoto($chemin){
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
    $req=$bdd->prepare("SELECT idphoto FROM photo where chemin=?");
    $req->execute(array($chemin));
    $photo=$req->fetch();
    return $photo['idphoto'];
    $req->closecursor();
}

function extraireidmateriel($nom){
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
    $req=$bdd->prepare("SELECT idmateriel FROM materiel where nommateriel=?");
    $req->execute(array($nom));
    $materiel=$req->fetch();
    $req->closeCursor();
    return $materiel['idmateriel'];
}

function photovalide($photo){
    
    /*on regarde si le fichier envoye est une image*/
    $subject = $photo['name'];
    $pattern = '/(gif|jpg|png)$/i';
    $a=0;
 
    $matches=preg_match($pattern, $subject, $tabMatches);
    if ($matches==0)
        {
        return 'Ce fichier n\'est pas une image reconnue';
        }
    else{
            $a++;
        }
 
    /*on verifie que le fichier envoye n'a pas un poid plus gros que celui defini*/
    $max=$_POST["max_file_size"];
    if (filesize($photo['tmp_name']) >$max)
    {
    return 'image trop grande, limitée à '.$max/1000 .'Ko';
    }
    else{
        $a++;
    }

    if ($a==2){
        return true;
    }
}

//verification qu'un formulaire a ete envoyer + on definis nos variable qui vienne du formulaire 
if(!empty($_POST)){
        extract($_POST);
        $valid = (boolean) true;

        if(isset($_POST['fichier'])){
            $titretuto = (String) trim($titretuto);
            $theme = (String) trim($theme);
            $textpresentation = (String) trim($textpresentation);
            $Materiel_1 = (String) trim($Materiel_1);
            $Materiel_2 = (String) trim($Materiel_2);
            $Materiel_3 = (String) trim($Materiel_3);
            $Materiel_4 = (String) trim($Materiel_4);
            $Materiel_5 = (String) trim($Materiel_5);
            $Materiel_6 = (String) trim($Materiel_6);
            $Materiel_7 = (String) trim($Materiel_7);
            $Materiel_8 = (String) trim($Materiel_8);
            $Materiel_9 = (String) trim($Materiel_9);
            $Materiel_10 = (String) trim($Materiel_10);
            $Materiel_11 = (String) trim($Materiel_11);
            $TexteEtape1 = (String) trim($TexteEtape1);
            $TexteEtape2 = (String) trim($TexteEtape2);
            $TexteEtape3 = (String) trim($TexteEtape3);
            $TexteEtape4 = (String) trim($TexteEtape4);
            $TexteEtape5 = (String) trim($TexteEtape5);
            $TexteEtape6 = (String) trim($TexteEtape6);
            $TexteEtape7 = (String) trim($TexteEtape7);
            $TexteEtape8 = (String) trim($TexteEtape8);
            $TexteEtape9 = (String) trim($TexteEtape9);
            $TexteEtape10 = (String) trim($TexteEtape10);
		$TexteEtape11 = (String) trim($TexteEtape11);
            $TexteEtape12 = (String) trim($TexteEtape12);
            $quantite_1 = (String) trim($quantite_1);
            $quantite_2 = (String) trim($quantite_2);
            $quantite_3 = (String) trim($quantite_3);
            $quantite_4 = (String) trim($quantite_4);
            $quantite_5 = (String) trim($quantite_5);
            $quantite_6 = (String) trim($quantite_6);
            $quantite_7 = (String) trim($quantite_7);
            $quantite_8 = (String) trim($quantite_8);
            $quantite_9 = (String) trim($quantite_9);
            $quantite_10 = (String) trim($quantite_10);
            $quantite_11= (String) trim($quantite_11);
            

        }

        //on affiche des messages des erreur pour guider le visiteur 
        if(empty($titretuto)){
                $valid = false;
                $err_titre = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs !</p>";
            }else{
                $req = $bdd->prepare("SELECT idtuto FROM tuto WHERE  titretuto= ?"); 
                $req->execute(array($titretuto)); 
                $tuto = $req->fetch();
                if(isset($tuto['idtuto'])){
                    $valid = false;
                    $err_titre = "<p style=\"color:#FF0000\";>Ce tuto existe déjà !</p>";
                }
            }
            
            if(empty($theme)){
                $valid = false;
                $err_theme = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs !</p>";
            }

            if(empty($textpresentation)){
                $valid = false;
                $err_textepresentation = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs !</p>";
            }

            if(empty($TexteEtape1)){
                $valid = false;
                $err_etape = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs une etape minimum est requise!</p>";
                
            }

            if(empty($Materiel_1)){
                $valid = false;
                $err_materiel = "<p style=\"color:#FF0000\";>Veuillez renseigner ce champs un materiel minimum est requis!</p>";
               
            }
	
	    if (true!==(photovalide($_FILES['photopresentation']))){
                $valid=false;
                $err_photo=photovalide($_FILES['photopresentation']);
            }

            //si tous va bien on commence a introduire dans la base 
            
            if($valid){
                //ajout d'un tuto 
                echo 'oui';
                
                $date=date("Y-m-d");
                $ajout=$bdd->prepare("INSERT INTO tuto(dateCreation,theme,titreTuto,textpresentation,idutilisateur) VALUES(?,?,?,?,?)");
                $ajout->execute(array($date,$theme,$titretuto,$textpresentation,$getid));
                $ajout->closeCursor();
                
                
                //on recupere l'indentifient du tuto 
                $req=$bdd->prepare("SELECT idtuto FROM tuto where titreTuto=?");
                $req->execute(array($titretuto));
                $tuto=$req->fetch();
                $req->closeCursor();
                $idtuto=$tuto['idtuto'];
                echo $idtuto;

                //ajout de la photo d'un tuto 

                $ajout=$bdd->prepare("INSERT INTO photo(datePhoto,chemin,idtuto) VALUES(?,?,?)");
                $ajout->execute(array($date,$_FILES['photopresentation']['name'],$idtuto));
                $ajout->closeCursor();

                //ajout d'une photo et de son etape 
                $compteur=1;
                while (!empty($_FILES['PhotoEtape'.$compteur.'']['name']) AND !empty(${'TexteEtape'.$compteur}) AND true==(photovalide($_FILES['PhotoEtape'.$compteur.''])))
		{
                    
                    
                    inserphoto($_FILES['PhotoEtape'.$compteur.'']['name']);
                    $idphoto=extraireidphoto($_FILES['PhotoEtape'.$compteur.'']['name']);
                    inseretape(${'TexteEtape'.$compteur},$idtuto,$idphoto);
                    $compteur=$compteur+1;
                }
                
                //ajout d'un materiel a la liste
                $compte=1;
                while(!empty(${'Materiel_'.$compte}) AND !empty(${'quantite_'.$compte})){
                    echo ${'Materiel_'.$compte}; 
                    
                    $ajout=$bdd->prepare("INSERT INTO materiel(nommateriel) VALUES(?)");
                    $ajout->execute(array(${'Materiel_'.$compte}));
                    $ajout->closeCursor();
                    $idmateriel=extraireidmateriel(${'Materiel_'.$compte});
                    $ajout=$bdd->prepare("INSERT INTO necessite(idmateriel,idtuto,quantité) VALUES(?,?,?)");
                    $ajout->execute((array($idmateriel,$idtuto,${'quantite_'.$compte})));
                    $ajout->closeCursor();
                    $compte++;
                }
            

                header('Location: projet.php'); 
                exit;
            }
        }
    

?>






<!DOCTYPE html>
<html lang="fr">

<!-- formulaire pour rentrer des nouveau tuto 
-->
	<head>
	<title>Ajouter un tuto</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" media="all" href="#">
	
	</head>
	<body>
		<h1>Nouveau Tuto</h1>
			
			<form action="formulaireTuto2.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="max_file_size" value="50000"/>
        			<p>
				<label>
					Catégorie Tuto : 
				</label>

				<select id="theme" name="theme">
					<option value="couture">Couture</option>
					<option value="decoration">Décoration</option>
					<option value="cosmetique">Cosmétique</option>
					<option value="cuisine">Cuisine</option>
					<option value="produit_menagers">Produits ménagers</option>
				</select><br/> 
					<?php
                			if(isset($err_theme)){
                    			echo $err_theme;
                			}
            				?>
					
				<label>
					Titre Tuto : 
				</label>
				
				<input type="text" name="titretuto"/><br/>
				<?php
                if(isset($err_titre)){
                    echo $err_titre;
                }
            ?>

				<label>
					Photo présentation : 
				</label><br />
				
                <input type="file" name="photopresentation" /><br />
				<?php
					if(isset($err_photo)){
                    			echo $err_photo;
                			}
            				?>
				
				<label>
					Texte présentation :
				</label>
				
				<textarea  name="textpresentation"
          rows="5" cols="33">
				</textarea>
		  <?php
                if(isset($err_textepresentation)){
                    echo $err_textepresentation;
                }
            ?>

				
				<label>
					Texte matériel nécessaire :
				</label>

				<ul>
					<li>
						<input type="text" name="Materiel_1" placeholder="nom du materiel"/>  <input type="text" name="quantite_1" placeholder="quantité"/>
					</li><br/>

					<li>
						<input type="text" name="Materiel_2" placeholder="nom du materiel"/>  <input type="text" name="quantite_2" placeholder="quantité"/>
					</li><br/>

					<li>
						<input type="text" name="Materiel_3" placeholder="nom du materiel"/>    <input type="text" name="quantite_3" placeholder="quantité"/>
					</li><br/>

					<li>
						<input type="text" name="Materiel_4" placeholder="nom du materiel"/>    <input type="text" name="quantite_4" placeholder="quantité"/>
					</li><br/>


					<li>
						<input type="text" name="Materiel_5" placeholder="nom du materiel"/>      <input type="text" name="quantite_5" placeholder="quantité"/>
					</li><br/>

					<li>
						<input type="text" name="Materiel_6" placeholder="nom du materiel"/>     <input type="text" name="quantite_6" placeholder="quantité"/>
					</li><br/>

					<li>
						<input type="text" name="Materiel_7" placeholder="nom du materiel"/>    <input type="text" name="quantite_7" placeholder="quantité"/>
					</li><br/>

					<li>
						<input type="text" name="Materiel_8" placeholder="nom du materiel"/>       <input type="text" name="quantite_8" placeholder="quantité"/>
					</li><br/>

					<li> 
						<input type="text" name="Materiel_9" />      <input type="text" name="quantite_9" placeholder="quantité"/>
					</li><br/>


					<li> 
						<input type="text" name="Materiel_10"/>      <input type="text" name="quantite_10" placeholder="quantité"/>
					</li><br/>

					<li> 
						<input type="text" name="Materiel_11" />      <input type="text" name="quantite_11" placeholder="quantité"/>
					</li><br/>
				</ul>

				<?php
                if(isset($err_materiel)){
                    echo $err_materiel;
                }
            	?>

				<label>
					Photo matériel nécessaire : 
				</label><br />
				
                <input type="file" name="PhotoListeMateriel" /><br />
		


				<label>
					Texte Etape 1 : 
				</label>
				
				<input type="text" name="TexteEtape1"><br/>
				
				<label>
					Photo Etape 1 : 
				</label><br />
				
                <input type="file" name="PhotoEtape1" /><br />
				
				
				
				<label>
					Texte Etape 2 : 
				</label>
				
				<input type="text" name="TexteEtape2"/><br/>
				
				<label>
					Photo Etape 2 : <br />
                </label>
				
				<input type="file" name="PhotoEtape2" /><br />
				

				<label>
					Texte Etape 3 : 
				</label>
				
				<input type="text" name="TexteEtape3"/><br/>
				
				<label> 
					Photo Etape 3 : 
				</label><br />
				
                <input type="file" name="PhotoEtape3" /><br />
				

				<label>
					Texte Etape 4 : 
				</label>
				
				<input type="text" name="TexteEtape4"/><br/>
				
				<label>
					Photo Etape 4 : <br />
				</label>
				
                <input type="file" name="PhotoEtape4" /><br />
				

				<label>
					Texte Etape 5: 
				</label>
				
				<input type="text" name="TexteEtape5"/><br/>
				
				<label>
					Photo Etape 5 : 
				</label><br />
				
                <input type="file" name="PhotoEtape5" /><br /> 
				
				<label>
					Texte Etape 6: 
				</label>
				
				<input type="text" name="TexteEtape6"/><br/>
				
				<label>
					Photo Etape 6 : 
				</label><br />
				
                <input type="file" name="PhotoEtape6" /><br /> 
				
				<label>
					Texte Etape 7: 
				</label>
				
				<input type="text" name="TexteEtape7"/><br/>
				
				<label>
					Photo Etape 7 : 
				</label><br />
				
                <input type="file" name="PhotoEtape7" /><br /> 
				


				<label>
					Texte Etape 8: 
				</label>
				
				<input type="text" name="TexteEtape8"/><br/>
				
				<label>
					Photo Etape 8 : 
				</label><br />
				
                <input type="file" name="PhotoEtape8" /><br /> 
				

			
				<label>
					Texte Etape 9: 
				</label>
				
				<input type="text" name="TexteEtape9"/><br/>
				
				<label>
					Photo Etape 9 : 
				</label><br />
				
                <input type="file" name="PhotoEtape9" /><br /> 
				
				
				<label>
					Texte Etape 10: 
				</label>
				
				<input type="text" name="TexteEtape10"/><br/>
				
				<label>
					Photo Etape 10 : 
				</label><br />
				
                <input type="file" name="PhotoEtape10"/><br /> <label>
				
				<label>
					Texte Etape 11: 
				</label>
				
				<input type="text" name="TexteEtape11"/><br/>
				
				<label>
					Photo Etape 11 : 
				</label><br />
				
                <input type="file" name="PhotoEtape11"/><br /> <label>

                		<label>
					Texte Etape 12: 
				</label>
				
				<input type="text" name="TexteEtape12"/><br/>
				
				<label>
					Photo Etape 12 : 
				</label><br />
				
                		<input type="file" name="PhotoEtape12"/><br /> <label>

				<?php
                if(isset($err_etape)){
                    echo $err_etape;
                }
            	?>


				
                <input type="submit" name="fichier" value="Envoyer les fichiers"/>
        </p>
</form>
			
	</body>
</html>
<?php
include 'bas.php';
?>
