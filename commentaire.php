<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Homemade - Commentaire</title>
		<meta charset="UTF-8">
		<link href="style-3.css" rel="stylesheet">
    </head>

    <body>

        <?php
            session_start();

            include("fonctionBD.php");

            $req_commentaire = $bdd->query("SELECT c.*, u.*, DATE_FORMAT(c.dateCommentaire, 'Le %d/%m/%Y') as date_c FROM commentaire c, utilisateur u, tuto t WHERE c.idutilisateur = u.idutilisateur AND t.idtuto = c.idtuto ORDER BY C.dateCommentaire DESC" ); 

            $req_commentaire = $req_commentaire->fetchAll();

            if(!empty($_POST)){
                extract($_POST); 
                $valid = true; 
	        if (isset($_POST['affiche'])){
                if($idtuto2=='tous'){
                    $req_commentaire = $bdd->query("SELECT c.*, u.*, DATE_FORMAT(c.dateCommentaire, 'Le %d/%m/%Y') as date_c FROM commentaire c, utilisateur u, tuto t WHERE c.idutilisateur = u.idutilisateur AND t.idtuto = c.idtuto  ORDER BY C.dateCommentaire DESC" ); 

                    $req_commentaire = $req_commentaire->fetchAll();
        
                }
                else{
                    $req_commentaire = $bdd->query("SELECT c.*, u.*, DATE_FORMAT(c.dateCommentaire, 'Le %d/%m/%Y') as date_c FROM commentaire c, utilisateur u, tuto t WHERE c.idutilisateur = u.idutilisateur AND t.idtuto = c.idtuto AND c.idtuto=? ORDER BY C.dateCommentaire DESC", array($idtuto2) ); 

                    $req_commentaire = $req_commentaire->fetchAll();

                }
            }

                if (isset($_POST['ajout-commentaire'])){
                    $contenucom = (String) trim($contenucom);

                    if(empty($contenucom)){
                        $valid = false;
                        $er_commentaire = "Il nous mettre un commentaire";
                    }elseif(iconv_strlen($contenucom, 'UTF-8') <= 3){
                        $valid = false;
                        $er_commentaire = "Il faut mettre plus de 3 caractères";
                    }

                    $contenucom = (String) trim($contenucom);

                   if($valid){
                        $dateCommentaire=date("Y-m-d");
                        $req=$bdd->insert("INSERT INTO commentaire (note_com, dateCommentaire, contenucom, idutilisateur,idtuto) VALUES ( ?, ?, ?, ?,?)" ,array($note_com, $dateCommentaire, $contenucom, $_SESSION['id'],$idtuto)); 
                        header('Location: commentaire.php'); 
                        

                        exit;
                    }

                }
            }

            
        ?>

        <?php
            include('fil.php');
        ?> 

        <div class="acceuil">
            <div class="titre-gd-h1">
                <h1>Commentaires : </h1>
            </div>
        
            <div class="commentaire-g">

                <p class="comm-1">Donnez-nous votre avis </p>

                <form method="post" action="commentaire.php" class="formulaireSuggestions">

                    <p class="titre-comm"><label>Nom du tuto :</label></p>
                     <?php
                        echo "<select name='idtuto'>";
                        $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
                        $req=$bdd->query("SELECT titreTuto, idtuto,theme FROM tuto ORDER BY theme");
                        while($tuto=$req->fetch()){
                            $themetuto2=$tuto['theme'];
                            if ($themetuto2!==$themetuto and !empty($themetuto)){
                                echo "</optgroup>";
                                echo "<optgroup label='$themetuto2'>";
                                $titreTuto=$tuto['titreTuto'];
                                $idtuto=$tuto['idtuto'];
                                echo "<option value='$idtuto'>$titreTuto</option>";
                            }
                            elseif($themetuto2==$themetuto and !empty($themetuto)){
                                $titreTuto=$tuto['titreTuto'];
                                $idtuto=$tuto['idtuto'];
                                $themetuto=$tuto['theme'];
                                echo "<option value='$idtuto'>$titreTuto</option>";
                            }
                            else{
                                $titreTuto=$tuto['titreTuto'];
                                $idtuto=$tuto['idtuto'];
                                $themetuto=$tuto['theme'];
                                echo "<optgroup label='$themetuto2'>";
                                echo "<option value='$idtuto'>$titreTuto</option>";

                            }
                        }
                        echo "</optgroup>";
                        echo "<option value='tous'>tous</option>";
                        echo "</select>"
                        ?>

                    <p class="titre-comm"><label>Ma note :</label></p>
                    <p class="note-commentaire">
                        <input type="radio" name="note_com" value="1" />1
                        <input type="radio" name="note_com" value="2" />2
                        <input type="radio" name="note_com" value="3" />3
                        <input type="radio" name="note_com" value="4" />4
                        <input type="radio" name="note_com" value="5" />5
                    </p>

                    <p class="titre-comm"><label>Mon commentaire :</label></p>
                        <p class="commentaire"><textarea class="texte-comm" name="contenucom"></textarea></p>

                    <p class="envoi-comm"><input class="envoi-comm-style" name="ajout-commentaire" type="submit" value="Envoyer"></p>
                </form>
		    
		<form method="post" action="commentaire.php" class="formulaireSuggestions">
               <?php
                        echo "<select name='idtuto2'>";
                        $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
                        $req=$bdd->query("SELECT titreTuto, idtuto,theme FROM tuto ORDER BY theme");
                        while($tuto2=$req->fetch()){
                            $themetuto2=$tuto2['theme'];
                            if ($themetuto2!==$themetuto and !empty($themetuto)){
                                echo "</optgroup>";
                                echo "<optgroup label='$themetuto2'>";
                                $titreTuto2=$tuto2['titreTuto'];
                                $idtuto2=$tuto2['idtuto'];
                                echo "<option value='$idtuto2'>$titreTuto2</option>";
                            }
                            elseif($themetuto2==$themetuto and !empty($themetuto)){
                                $titreTuto2=$tuto2['titreTuto'];
                                $idtuto2=$tuto2['idtuto'];
                                $themetuto=$tuto2['theme'];
                                echo "<option value='$idtuto2'>$titreTuto2</option>";
                            }
                            else{
                                $titreTuto2=$tuto2['titreTuto'];
                                $idtuto2=$tuto2['idtuto'];
                                $themetuto=$tuto2['theme'];
                                echo "<optgroup label='$themetuto2'>";
                                echo "<option value='$idtuto2'>$titreTuto2</option>";

                            }
                        }
                        echo "</optgroup>";
                        echo "<option value='tous'>tous</option>";
                        echo "</select>"
                        ?>
                    <input type="submit" name="affiche" value="afficher">


                <table class="liste_commentaire">
                    <?php
                        foreach($req_commentaire as $rc){
                        ?>
                            <tr>
                                <td class="list_com_personne">
                                    <?= "De " . $rc['pseudo'] ?>
                                </td>
                                <td class="list_com_tuto">
                                    <?= " TUTO" . $rc['pseudo'] ?>
                                </td>
                                <td class="list_com_note">
                                    <?= $rc['note_com'] . " / 5" ?>
                                </td>
                                <td class="list_com_contenu">
                                    <?= $rc['contenucom'] ?>
                                </td>
                                <td class="list_com_date">
                                    <?= $rc['date_c'] ?>
                                </td>
                            </tr>
                        <?php
                        }
                    ?>
                    
                </table>

            </div>
                
	
	</div>
        

        <?php
            include('bas.php');
        ?> 

    </body>
</html>
