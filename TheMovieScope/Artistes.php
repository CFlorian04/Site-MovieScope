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
while($donnee = $rep->fetch())
{
    echo '<th>NOM</th><tr align="center"><td >'.$donnee['nom'].'</td></tr>';
    echo '<th>PRENOM</th><tr align="center"><td >'.$donnee['prenom'].'</td></tr>';
    echo '<th>DATE DE NAISSANCE</th><tr align="center"><td >'.$donnee['dateNaiss'].'</td></tr>';
    echo '<td><a href="Suppression.php?id='.$donnee['idArtiste'].'&genre=artiste"><button>Supprimer</button></a></td>';
    echo '<td><a href="Modification.php?id='.$donnee['idArtiste'].'&genre=artiste&nom='.$donnee['nom'].'&prenom='.$donnee['prenom'].'&date='.$donnee['dateNaiss'].'"><button>Modifier</button></a></td>';
}
echo'</table>';?>
</body>
</html>
