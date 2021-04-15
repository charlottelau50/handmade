<?php
error_reporting(E_ALL) ; 
echo "Je suis la page de réception des données" ;
var_dump($_POST) ;
var_dump($_FILES) ;
echo $_FILES['PhotoPresentation'] ;
?>