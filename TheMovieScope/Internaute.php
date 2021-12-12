<?php
session_start();
if(isset($_SESSION['admin'])){
if ($_SESSION['admin'] == 1 ) {
header('location:Admin.php');
}}
else
header('location:Index.php');
if(isset($_GET['menu']))
$menu=$_GET['menu'];
else
$menu="film";
echo'<div id="menu" style="display: none">'.$menu.'</div>'
?>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Internaute</title>
<script src="js/Affichage.js"></script>
<link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
<nav>
<div class="navbar">
<div class="logo"><a>TheMovieScope</a></div>
<div class="nav-links">
    <ul class="links">
        <li><button onclick="Menu_film()">Films</button></li>
        <li><button onclick="Menu_artiste()">Artistes</button></li>
        <li>
            <button onclick="Menu_genre()">Genre</button>
            <i class='bx bxs-chevron-down arrow '></i>
            <ul class="js-sub-menu sub-menu">
                <?php
                try{
                    $bdd = new PDO('mysql:host=localhost;dbname=cinema','root','');
                }
                catch(Exception $e){
                    die('Erreur de connexion : '.$e->getMessage());}
                $rep = $bdd->query('SELECT * FROM cinema.genre;');
                while($donnee = $rep->fetch()) {
                    echo '<li><a href="Internaute.php?menu=genre&genrefilm='.$donnee['libelle'].'">'.$donnee['libelle'].'</a></li>';
                }
                ?>
            </ul>
        </li>
        <li></li>
        <li><a href="Profil.php">Profil</a></li>
        <li><a href="Index.php">Déconnexion</a></li>
    </ul>
</div>
<div class="logo"><a><img src="assets/img/logo_TheMovieScope_HD.png" width="125" height="70" /></a></div>
</div>
<?php
try{
$bdd = new PDO('mysql:host=localhost;dbname=cinema','root','');
}
catch(Exception $e){
die('Erreur de connexion : '.$e->getMessage());}

//////////////////////////////////////////////////////////Requete pour afficher les films/////////////////////////////////////////////////////////////////////////////////////////////

echo'<table id="table_film" style="display: none">';
$rep = $bdd->query('SELECT * FROM cinema.film ;');
while($donnee = $rep->fetch())
{
echo '<td><a href="Film.php?id='.$donnee["idFilm"].'"><img title="'.$donnee['titre'].'" alt="Ce film ne possède pas d\'illustration" height="200px" width="150px" src="'.$donnee['image'].'"></a></td>';
}
echo'</table>';
//////////////////////////////////////////////////////////Requete pour afficher les artistes/////////////////////////////////////////////////////////////////////////////////////////////
$rep = $bdd->query('SELECT * FROM cinema.artiste;');
echo'<table id="table_artiste" style="display: none">';
while($donnee = $rep->fetch())
{
echo '<td><a href="Artistes.php?id='.$donnee["idArtiste"].'"><img title="'.$donnee['prenom']." ".$donnee['nom'].'" alt="Cet artiste ne possède pas d\'illustration" height="125px" width="100px" src="'.$donnee['image'].'"></a></td>';
}
echo'</table>';

//////////////////////////////////////////////////////////Requete pour afficher les genres/////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET["genrefilm"])){
$rep = $bdd->query('SELECT * FROM cinema.film INNER JOIN cinema.genre ON film.Genre_idGenre = genre.idGenre  where libelle="'.$_GET["genrefilm"].'";');

echo'<table id="table_genre">';
if($rep->rowCount()<=0) {
    echo '<td>Il n\'existe pas de film de ce genre</td>';
}
while($donnee = $rep->fetch())
{
if($donnee["idFilm"]==NULL)
    echo'qcs';
echo '<td><a href="Film.php?id='.$donnee["idFilm"].'"><img title="'.$donnee['titre'].'" alt="Ce film ne possède pas d\'illustration" height="200px" width="150px" src="'.$donnee['image'].'"></a></td>';
}
echo'</table>';}
?>
</nav>
</body>

<script>
if(document.getElementById("menu").outerText==="film"){
Menu_film();
}

if(document.getElementById("menu").outerText==="artiste"){
Menu_artiste();
}

if(document.getElementById("menu").outerText==="genre"){
Menu_genre();
}

if(document.getElementById("menu").outerText==="internautes"){
Menu_internaute();
}
</script>

</html>