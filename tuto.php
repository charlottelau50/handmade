<?php
//INSERT INTO `etape` (`idetape`, `titre`, `texte`, `idtuto`, `idphoto`) VALUES (NULL, 'Etape1', 'Etape1_texte', '101', '')

$html = file_get_contents ( "tuto.html"); 

function http_redirect($url, $statusCode = 303) {
  header('Location: ' . $url, true, $statusCode);
  die();
}

if ( $html === false ) {
	http_redirect("erreur.html");
	exit();
}

else {

	$connx = new mysqli("localhost", "root", "", "projet",  );

	$idTuto = $_GET['id'];

	if ($connx->connect_errno)
		die("Echec lors de la connexion MySQL");


	

	$req = 'SELECT * FROM tuto t, etape e, photo p WHERE t.idtuto = e.idtuto AND e.idphoto = p.idphoto AND t.idtuto = '.$idTuto;
	
	$data = $connx->query($req);

	if ($data == NULL)
		die("Problème d'exécution de la requête \n");
	

//	$img_tuto = $info['img_tuto'];
	$titre_tuto = null;
	$date_tuto = null;
	$presentation_tuto = null;
	$liste_materiel = null;

	$htmlEtapes = "";
	$i = 1;
	while($info = $data->fetch_assoc()) {

		$titre_tuto = $info['titreTuto'];
		$date_tuto = $info['dateCreation'];
		$presentation_tuto = $info['textpresentation'];
		$img_tuto = "";
		

		$idEtape = $info['idetape'];
		$texteEtape = $info['texte'];

		$cheminPhoto = $info['chemin'];

		$htmlEtape = file_get_contents ( "tuto_etape.html"); 
		$htmlEtape = str_replace('[[idEtape]]', $i, $htmlEtape);
		$htmlEtape = str_replace('[[texte_etape]]', $texteEtape, $htmlEtape);
		$htmlEtape = str_replace('[[img_etape]]', $cheminPhoto, $htmlEtape);
		
		$htmlEtapes .= $htmlEtape;
		$i++;
	}
	

/// MAteriel
	$req = "SELECT * FROM necessite n, materiel m WHERE n.idmateriel = m.idmateriel AND n.idtuto = $idTuto";
	$data = $connx->query($req);

	if ($data == NULL)
		die("Problème d'exécution de la requête 2 \n");
	


	$htmlListeMateriels = "<ul>";
	while($info = $data->fetch_assoc()) {
		$htmlListeMateriels .= '<li>'.$info['nommateriel'].'</li>';
	}
	$htmlListeMateriels .= "<ul>";




	$html = str_replace('[[img_tuto]]', $img_tuto, $html);
	$html = str_replace('[[titreTuto]]', $titre_tuto, $html);
	$html = str_replace('[[dateCreation]]', $date_tuto, $html);
	$html = str_replace('[[TextePresentation]]', $presentation_tuto, $html);
	$html = str_replace('[[ETAPES]]', $htmlEtapes, $html);
	$html = str_replace('[[ListeMateriel]]', $htmlListeMateriels, $html);

	echo $html;

}

