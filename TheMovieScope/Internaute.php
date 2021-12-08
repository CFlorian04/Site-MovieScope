<?php
session_start();
if(isset($_SESSION['admin'])){
    if ($_SESSION['admin'] == 1 ) {
        header('location:Admin.php');
    }}
else
    header('location:Index.php');
echo'</br></br></br>';
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
<div>
    <nav>
        <div class="navbar">
            <div class="logo"><a>TheMovieScope</a></div>
            <div class="nav-links">
                <ul class="links">
                    <li>
                        <a>Films</a>
                        <i class='bx bxs-chevron-down arrow  '></i>
                        <ul class="js-sub-menu sub-menu">
                            <li><button onclick="Menu_film()">Lire</button></li>
                            <li><a href="Ajout.php?action=film">Ajout</a></li>
                        </ul>
                    </li>
                    <li>
                        <a>Artistes</a>
                        <i class='bx bxs-chevron-down arrow '></i>
                        <ul class="js-sub-menu sub-menu">
                            <li><button onclick="Menu_artiste()">Lire</button></li>
                            <li><a href="Ajout.php?action=artiste">Ajout</a></li>
                        </ul>
                    </li>
                    <li>
                        <a>Genres</a>
                        <i class='bx bxs-chevron-down arrow '></i>
                        <ul class="js-sub-menu sub-menu">
                            <li><button onclick="Menu_genre()">Lire</button></li>
                            <li><a href="Ajout.php?action=genre">Ajout</a></li>
                        </ul>
                    </li>
                    <li><button onclick="Menu_internaute()">Internaute</button></li>
                    <li><a href="Profil.php">Profil</a></li>
                    <li><div class="logo"><a href="Index.php">Déconnexion</a></div></li>
                </ul>
            </div>
            <div class="logo"><a><img src="assets/img/logo_TheMovieScope_HD.png" width="125" height="70" /></a></div>
        </div>
    </nav>
    <script src="js/admin.js"></script>
</div>
<?php
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
    echo '<td><a href="Suppression.php?id='.$donnee['idFilm'].'&genre=film"><button>Supprimer</button></a></br></td>';
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
</body>