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
                        $req = $bdd->insert("INSERT INTO commentaire (note_com, dateCommentaire, contenucom, idutilisateur, idtuto) VALUES (?, ?, ?, ?, ?)"); 
                        $req->execute(array($note_com, $dateCommentaire, $contenucom, $_SESSION['idutilisateur'], $idtuto));
                        header('Location: comment.php'); 
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

                <form method="post" action="comment.php" class="formulaireSuggestions">

                    <p class="titre-comm"><label>Nom du tuto :</label></p>
                    <select name="idtuto">
                        <optgroup label="Couture">
                            <option value="Chouchou">Chouchou</option>
                            <option value="Couvercle en tissu">Couvercle en tissu</option>
                        </optgroup>
                        <optgroup label="Décoration">
                            <option value="Toile">Toile</option>
                            <option value="Semainier">Semainier</option>
                        </optgroup>
		            </select>

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
