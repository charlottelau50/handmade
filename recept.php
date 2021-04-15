<?php
error_reporting(E_ALL) ; 
echo "Je suis la page de réception des données" ;
var_dump($_POST) ;
var_dump($_FILES) ;
echo $_FILES['PhotoPresentation'] ;

require_once("../../initCore.php");




$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );

$extension_upload = strtolower(  substr(  strrchr($_FILES['PhotoPresentation']['name'], '.')  ,1)  );

$cheminImageSurServeur = DIR_SRV."images/".$_FILES['PhotoPresentation']['name'];
$resultat = move_uploaded_file($_FILES['PhotoPresentation']['tmp_name'],$cheminImageSurServeur);

$urlServeur = "/images/".$_FILES['PhotoPresentation']['name'];

echo $resultat;

?>



