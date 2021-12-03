<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin </title>
</head>
<body>
<div id="logo">
    <img src="">
    <h1>Nom du site</h1>
</div>
<div>
    <table>
        <tr>
            <th ><button onclick="Menu_film()">Film</button></th>
            <th ><button onclick="Menu_artiste()">Artiste</button></th>
            <th ><button onclick="Menu_genre()">Genre</button></th>
            <th ><button onclick="Menu_internautes()">Internautes</button></th>
            <th ><button onclick="">Profil</button></th>
        </tr>
    </table>
</div>
<?php
session_start();
//Requete pour afficher les films
echo'<table id="table_film" style="display: none">
    <tr>
        <th>TITRE</th>
        <th>GENRE</th>
        <th>NOM DU RÉALISATEUR</th>
        <th>PRÉNOM DU RÉALISATEUR</th>
        <th>DATE DE SORTIE</th>
    </tr>';

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
echo'</table>';

//Requete pour afficher les artistes
echo'<table id="table_artiste" style="display: none">
    <tr>
        <th>NOM DU RÉALISATEUR</th>
        <th>PRÉNOM DU RÉALISATEUR</th>
        <th>DATE DE NAISSANCE</th>
    </tr>';

try{
    $bdd = new PDO('mysql:host=localhost;dbname=cinema','root','');
}
catch(Exception $e){
    die('Erreur de connexion : '.$e->getMessage());}
$rep = $bdd->query('SELECT * FROM cinema.artiste;');
while($donnee = $rep->fetch())
{
    echo '<tr>';
    echo '<td>'.$donnee['nom'].'</td>';
    echo '<td>'.$donnee['prenom'].'</td>';
    echo '<td>'.$donnee['dateNaiss'].'</td>';
    echo '</tr>';
}
echo'</table>';

//Requete pour afficher les genres
echo'<table id="table_genre" style="display: none">
    <tr>
        <th>LIBELLE</th>
    </tr>';

try{
    $bdd = new PDO('mysql:host=localhost;dbname=cinema','root','');
}
catch(Exception $e){
    die('Erreur de connexion : '.$e->getMessage());}
$rep = $bdd->query('SELECT * FROM cinema.genre;');
while($donnee = $rep->fetch())
{
    echo '<tr>';
    echo '<td>'.$donnee['libelle'].'</td>';
    echo '</tr>';
}
echo'</table>';

//Requete pour afficher les internautes
echo'<table id="table_internautes" style="display: none">
    <tr>
        <th>NOM</th>
        <th>PRENOM</th>
    </tr>';

try{
    $bdd = new PDO('mysql:host=localhost;dbname=cinema','root','');
}
catch(Exception $e){
    die('Erreur de connexion : '.$e->getMessage());}
$rep = $bdd->query('SELECT * FROM cinema.internaute;');
while($donnee = $rep->fetch())
{
    echo '<tr>';
    echo '<td>'.$donnee['nom'].'</td>';
    echo '<td>'.$donnee['Prenom'].'</td>';
    echo '</tr>';
}
echo'</table>';

?>

<script>
    function Menu_film() {
        document.getElementById("table_film").setAttribute("style","display:block");
        document.getElementById("table_artiste").setAttribute("style","display:none");
        document.getElementById("table_genre").setAttribute("style","display:none");
        document.getElementById("table_internautes").setAttribute("style","display:none");
    }
    function Menu_artiste() {
        document.getElementById("table_film").setAttribute("style","display:none");
        document.getElementById("table_artiste").setAttribute("style","display:block");
        document.getElementById("table_genre").setAttribute("style","display:none");
        document.getElementById("table_internautes").setAttribute("style","display:none");
    }
    function Menu_genre() {
        document.getElementById("table_film").setAttribute("style","display:none");
        document.getElementById("table_artiste").setAttribute("style","display:none");
        document.getElementById("table_genre").setAttribute("style","display:block");
        document.getElementById("table_internautes").setAttribute("style","display:none");
    }
    function Menu_internautes() {
        document.getElementById("table_film").setAttribute("style","display:none");
        document.getElementById("table_artiste").setAttribute("style","display:none");
        document.getElementById("table_genre").setAttribute("style","display:none");
        document.getElementById("table_internautes").setAttribute("style","display:block");
    }
</script>

</body>