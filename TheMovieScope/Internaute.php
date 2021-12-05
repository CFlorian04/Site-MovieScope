<html lang="fr">
<head>
    <meta charset="UTF-8-UNICODE">
    <title>Internaute</title>
</head>
<body>
<div id="logo">
    <img src="">
    <h1>Nom du site</h1>
</div>
<div>
    <table>
        <tr>

            <th><button onclick="Menu_film()" id="film">Film</button></th>
            <th><button onclick="Menu_artiste()" id="artiste">Artiste</button></th>
            <th><button onclick="">Profil</button></th>
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
        <th>RÉALISATEUR</th>
        <th>DATE DE SORTIE</th>
        <th>RESUME</th>
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
    echo '<td>'.$donnee['prenom']." ".$donnee['nom'].'</td>';
    echo '<td>'.$donnee['annee'].'</td>';
    echo '<td>'.utf8_encode($donnee['resume']).'</td>';
    echo '<td><a href="InternauteModif.php?id='.$donnee['idFilm'].'&film='.$donnee['titre'].'&genre=film&date='.$donnee['annee'].'&type='.$donnee['libelle'].'&artiste='.$donnee['prenom']." ".$donnee['nom'].'&resume='.urlencode($donnee['resume']).'"><button>Modifier</button></a></td>';
    echo '</tr>';
}
echo'</table>';

//Requete pour afficher les artistes
echo'<table id="table_artiste" style="display: none">
    <tr>
        <th>NOM</th>
        <th>PRÉNOM</th>
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

?>
<script>
    function Menu_film() {
        if(document.getElementById("film")){
            document.getElementById("table_film").setAttribute("style","display:block");
            document.getElementById("table_artiste").setAttribute("style","display:none");
            document.getElementById("table_genre").setAttribute("style","display:none");
            document.getElementById("table_internautes").setAttribute("style","display:none");
        }
    }
    function Menu_artiste() {
        if(document.getElementById("artiste")){
            document.getElementById("table_artiste").setAttribute("style","display:block");
            document.getElementById("table_film").setAttribute("style","display:none");
            document.getElementById("table_genre").setAttribute("style","display:none");
            document.getElementById("table_internautes").setAttribute("style","display:none");
        }
    }

</script>
</body>