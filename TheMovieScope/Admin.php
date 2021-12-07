<?php
session_start();
if(isset($_SESSION['admin'])){
if ($_SESSION['admin'] == 0 ) {
    header('location:Internaute.php');
}}
else
    header('location:Index.php');
?>
<html lang="fr">
<head>
    <script src="js/javascript.js"></script>
    <meta charset="UTF-8">
    <title>Admin</title>
</head>
<body>
<div id="logo">
    <img src="">
    <h1>TheMovieScope</h1>
</div>
<a href="Index.php">Déconnexion</a>
<div>
    <table>
        <tr>
            <th ><button onclick="Menu_film()">Film <select id="film""><option>Lire</option><option>Ajout</option></select></button></th>
            <th ><button onclick="Menu_artiste()">Artiste<select id="artiste"><option>Lire</option><option>Ajout</option></select></button></th>
            <th ><button onclick="Menu_genre()">Genre<select id="genre"><option>Lire</option><option>Ajout</option></select></button></th>
            <th ><button onclick="Menu_internautes()">Internautes</button></th>
            <th ><button onclick="">Profil</button></th>
        </tr>
    </table>
</div>
<?php
if ($_SESSION['admin']==0){header('Internaute.php');}
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
    echo '<td><a href="Suppression.php?id='.$donnee['idFilm'].'&genre=film"><button >Supprimer</button></a></td>';
    echo '<td><a href="Modification.php?id='.$donnee['idFilm'].'&film='.$donnee['titre'].'&genre=film&date='.$donnee['annee'].'&type='.$donnee['libelle'].'&artiste='.$donnee['prenom']." ".$donnee['nom'].'&resume='.urlencode($donnee['resume']).'"><button>Modifier</button></a></td>';
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
    echo '<td><a href="Suppression.php?id='.$donnee['idArtiste'].'&genre=artiste"><button>Supprimer</button></a></td>';
    echo '<td><a href="Modification.php?id='.$donnee['idArtiste'].'&genre=artiste&nom='.$donnee['nom'].'&prenom='.$donnee['prenom'].'&date='.$donnee['dateNaiss'].'"><button>Modifier</button></a></td>';
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
    echo '<td><a href="Suppression.php?id='.$donnee['idGenre'].'&genre=genre"><button>Supprimer</button></a></td>';
    echo '<td><a href="Modification.php?id='.$donnee['idGenre'].'&genre=genre&libelle='.$donnee['libelle'].'"><button>Modifier</button></a></td>';
    echo '</tr>';
}
echo'</table>';

//Requete pour afficher les internautes
echo'<table id="table_internautes" style="display: none">
    <tr>
        <th>NOM</th>
        <th>PRENOM</th>
        <th>ADMIN</th>
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
    echo '<td>'.$donnee['prenom'].'</td>';
    echo '<td>'.$donnee['admin'].'</td>';
    echo '<td><a href="Suppression.php?id='.$donnee['idInternaute'].'&genre=internautes"><button>Supprimer</button></a></td>';
    echo '<td><a href="Modification.php?id='.$donnee['idInternaute'].'&nom='.$donnee['nom'].'&prenom='.$donnee['prenom'].'&admin='.$donnee['admin'].'&genre=internautes"><button>Modifier</button></a></td>';
    echo '</tr>';
}
echo'</table>';

?>
<script>
    function Menu_film() {
        if(document.getElementById("film").value==="Lire"){
        document.getElementById("table_film").setAttribute("style","display:block");
        document.getElementById("table_artiste").setAttribute("style","display:none");
        document.getElementById("table_genre").setAttribute("style","display:none");
        document.getElementById("table_internautes").setAttribute("style","display:none");
        }
        if(document.getElementById("film").value==="Ajout"){
            window.location = "Ajout.php?action=film";
        }
    }
    function Menu_artiste() {
        if(document.getElementById("artiste").value==="Lire"){
            document.getElementById("table_artiste").setAttribute("style","display:block");
            document.getElementById("table_film").setAttribute("style","display:none");
            document.getElementById("table_genre").setAttribute("style","display:none");
            document.getElementById("table_internautes").setAttribute("style","display:none");
        }
        if(document.getElementById("artiste").value==="Ajout"){
            window.location = "Ajout.php?action=artiste";
        }
    }
    function Menu_genre() {
        if(document.getElementById("genre").value==="Lire"){
            document.getElementById("table_genre").setAttribute("style","display:block");
            document.getElementById("table_film").setAttribute("style","display:none");
            document.getElementById("table_artiste").setAttribute("style","display:none");
            document.getElementById("table_internautes").setAttribute("style","display:none");
        }
        if(document.getElementById("genre").value==="Ajout"){
            window.location = "Ajout.php?action=genre";
        }
    }
    function Menu_internautes() {
            document.getElementById("table_internautes").setAttribute("style","display:block");
            document.getElementById("table_film").setAttribute("style","display:none");
            document.getElementById("table_artiste").setAttribute("style","display:none");
            document.getElementById("table_genre").setAttribute("style","display:none");
    }
</script>
</body>