<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <title>Nom du site</title>
</head>
<body>
<?php
session_start();
if($_SESSION['admin']==1)
    echo'<a href="Admin.php?menu=artiste">Retour</a>';
else
    echo'<a href="Internaute.php?menu=artiste">Retour</a>';
$id=$_GET['id'];
echo'<table id="table_artiste">';
try{
    $bdd = new PDO('mysql:host=localhost;dbname=cinema','root','');
}
catch(Exception $e){
    die('Erreur de connexion : '.$e->getMessage());}
$rep = $bdd->query('SELECT * FROM cinema.artiste WHERE idArtiste='.$id.';');
while($donnee = $rep->fetch()) {
    $age = date("Y-m-d") - $donnee['dateNaiss'] ;
    echo    '<th><img height="200px" width="150px" src="'.$donnee['image'].'">'.
            '<h2>'.$donnee['prenom'] . ' ' . $donnee['nom'] . '</h2>'.
            ' Date de naissance :' . $donnee['dateNaiss'] ." (". $age." ans)".''.
            '</th>';

    if ($_SESSION['admin'] == 1) {
        echo '  <td><a href="Suppression.php?id=' . $donnee['idArtiste'] . '&genre=artiste"><button>Supprimer</button></a></td>
                <td><a href="Modification.php?id=' . $donnee['idArtiste'] . '&genre=artiste&nom=' . $donnee['nom'] . '&prenom=' . $donnee['prenom'] . '&date=' . $donnee['dateNaiss'] . '"><button>Modifier</button></a></td>';
    }
}
?>
</table>
</body>
</html>
