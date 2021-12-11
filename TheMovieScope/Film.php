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
    echo'<a href="Admin.php?menu=film">Retour</a>';
else
    echo'<a href="Internaute.php?menu=film">Retour</a>';
$id=$_GET['id'];
echo'<table>';
try{
    $bdd = new PDO('mysql:host=localhost;dbname=cinema','root','');
}
catch(Exception $e){
    die('Erreur de connexion : '.$e->getMessage());}
$rep = $bdd->query('SELECT * FROM cinema.film INNER JOIN cinema.genre ON film.Genre_idGenre = genre.idGenre INNER JOIN cinema.artiste ON film.Artiste_idRealisateur=artiste.idArtiste WHERE idFilm='.$id.' ;');
while($donnee = $rep->fetch())
{
    echo '<th>TITRE</th><tr align="center"><td >'.$donnee['titre'].'</td></tr>';
    echo '<th>GENRE</th><tr align="center"><td>'.$donnee['libelle'].'</td></tr>';
    echo '<th>REALISATEUR</th><tr align="center"><td>'.$donnee['prenom']." ".$donnee['nom'].'</td></tr>';
    echo '<th>DATE DE SORTIE</th><tr align="center"><td>'.$donnee['annee'].'</td></tr>';
    echo '<th>RESUME</th><tr align="center"><td>'.utf8_encode($donnee['resume']).'</td></tr>';
    echo '<tr><td><a href="Suppression.php?id='.$donnee['idFilm'].'&genre=film"><button>Supprimer</button></a></td>';
    echo '<td><a href="Modification.php?id='.$donnee['idFilm'].'&film='.$donnee['titre'].'&genre=film&date='.$donnee['annee'].'&type='.$donnee['libelle'].'&artiste='.$donnee['prenom']." ".$donnee['nom'].'&resume='.urlencode($donnee['resume']).'"><button>Modifier</button></a></td></tr>';
}
echo'</table>';