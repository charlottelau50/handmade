<?php

$html = file_get_contents ( "tuto.html"); 

if ( $html === false ) {
	http_redirect("erreur.html");
	exit();
}

else {

	$req = 'select nom, prenom, image, biographie
			from archer
			where idarcher='. $__GET['id'];

	$connx = new mysqli("localhost", "root", "", "", );
	
	if ($connx->connect_errno)
		die("Echec lors de la connexion MySQL");

	$data = $connx->query($req);

	if ($data == NULL)
		die("Problème d'exécution de la requête \n");
	
	$info = $data->fetch_assoc();
	
	$img_tuto = $info['img_tuto'];
	$titre_tuto = $info['TitreTuto'];
	$date_tuto = $info['dateCreation'];
	$presentation_tuto = $info['TextePresentation'];
	$liste_materiel = $info['ListeMateriel'];
	$liste_materiel = $info['img_etape1'];
	$liste_materiel = $info['texte_etape1'];
	$liste_materiel = $info['img_etape2'];
	$liste_materiel = $info['texte_etape2'];
	$liste_materiel = $info['img_etape3'];
	$liste_materiel = $info['texte_etape3'];
	$liste_materiel = $info['img_etape4'];
	$liste_materiel = $info['texte_etape4'];

	$html = str_replace('[[img_tuto]]', $img_tuto, $html);
	$html = str_replace('[[TitreTuto]]', $titre_tuto, $html);
	$html = str_replace('[[dateCreation]]', $date_tuto, $html);
	$html = str_replace('[[TextePresentation]]', $presentation_tuto, $html);
	$html = str_replace('[[img_etape1]]', $liste_materiel, $html);
	$html = str_replace('[[texte_etape1]]', $date_tuto, $html);
	$html = str_replace('[[img_etape2]]', $liste_materiel, $html);
	$html = str_replace('[[texte_etape2]]', $date_tuto, $html);
	$html = str_replace('[[img_etape3]]', $liste_materiel, $html);
	$html = str_replace('[[texte_etape3]]', $date_tuto, $html);
	$html = str_replace('[[img_etape4]]', $liste_materiel, $html);
	$html = str_replace('[[texte_etape4]]', $date_tuto, $html);

	echo $html;

}

