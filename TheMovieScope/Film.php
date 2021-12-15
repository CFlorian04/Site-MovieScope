<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>The Movie Scope</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
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
    echo '<th>REALISATEUR</th><tr align="center"><td>'.$donnee[11]." ".$donnee[10].'</td></tr>';
    echo '<th>DATE DE SORTIE</th><tr align="center"><td>'.$donnee['annee'].'</td></tr>';
    echo '<th>RESUME</th><tr align="center"><td>'.utf8_encode($donnee['resume']).'</td></tr>';
    if($_SESSION['admin']==1){
    echo '<tr><td><a href="Suppression.php?id='.$donnee['idFilm'].'&genre=film"><button>Supprimer</button></a></td>';
    echo '<td><a href="Modification.php?id='.$donnee['idFilm'].'&film='.$donnee['titre'].'&genre=film&date='.$donnee['annee'].'&type='.$donnee['libelle'].'&artiste='.$donnee['prenom']." ".$donnee['nom'].'&resume='.urlencode($donnee['resume']).'&image='.$donnee[6].'"><button>Modifier</button></a></td></tr>';
    }
}
echo'<th>NOTE TOTAL</th>';
$rep = $bdd->query('SELECT * FROM cinema.noter WHERE Film_idFilm='.$id.' ;');
$total=0;
$dénominateur=0;
while($donnee = $rep->fetch())
{
    $total=$total+$donnee['note'];
    $dénominateur=$dénominateur+10;
}
if($dénominateur!=0)
$total=($total/$dénominateur)*10;
echo '<tr align="center"><td><strong>'.round($total, 1).'</strong></td></tr>';
echo'<th>COMMENTAIRE</th>';
$rep = $bdd->query('SELECT * FROM cinema.film LEFT JOIN  cinema.noter ON idFilm=Film_idFilm  LEFT JOIN cinema.internaute ON idInternaute=Internaute_idInternaute WHERE idFilm='.$id.' ;');
while($donnee = $rep->fetch())
{
    if($donnee['commentaire']!=NULL){echo '<tr align="center"><td><strong>'.$donnee['prenom'].': </strong>'.utf8_encode($donnee['commentaire']).'<strong> Note: '.$donnee['note'].'</strong></td></tr>';}
}
if($_SESSION['admin']==0){
    echo '<tr align="center"><td><a href="Noter.php?id='.$id.'"><button>Commenter</button></a></td>';
}
echo'</table>';