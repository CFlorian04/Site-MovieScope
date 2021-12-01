<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Internaute </title>
</head>
<body>
<div id="logo">
    <img src="">
    <h1>Nom du site</h1>
</div>
<div>
    <table>
        <tr>
            <th id="" onclick="">Film</th>
            <th id="" onclick="">Artiste</th>
            <th id="" onclick="">Genre</th>
            <th id="" onclick="">Internautes</th>
            <th id="" onclick="">Profil</th>
        </tr>
    </table>
</div>
<table>
    <tr>
        <th>TITRE</th>
        <th>GENRE</th>
        <th>NOM DU RÉALISATEUR</th>
        <th>PRÉNOM DU RÉALISATEUR</th>
        <th>DATE DE SORTIE</th>
    </tr>
<?php
session_start();
try{
    $bdd = new PDO('mysql:host=localhost;dbname=cinema','root','');
}
catch(Exception $e){
    die('Erreur de connexion : '.$e->getMessage());}
$rep = $bdd->query('SELECT * FROM cinema.film INNER JOIN cinema.genre ON film.Genre_idGenre = genre.idGenre INNER JOIN cinema.artiste ON film.Artiste_idRealisateur=artiste.idArtiste;');
while($donnee = $rep->fetch())
{
    echo '<tr>';
    echo '<td>'.$donnee['titre'].'</td>';
    echo '<td>'.$donnee['libelle'].'</td>';
    echo '<td>'.$donnee['nom'].'</td>';
    echo '<td>'.$donnee['prenom'].'</td>';
    echo '<td>'.$donnee['annee'].'</td>';
    echo '</tr>';
}
?>
</table>
</body>