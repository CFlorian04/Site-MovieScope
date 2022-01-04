<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Artiste - TheMovieScope</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
</head>
<body>

<nav>
    <div class="navbar">
        <div class="logo"><a>TheMovieScope</a></div>
        <div class="nav-links">
            <ul class="links">
                <li><a href="Admin.php">Accueil</a></li>
                <li><a href="Profil.php">Profil</a></li>
                <li><a href="Index.php">Déconnexion</a></li>
            </ul>
        </div>
        <div class="logo"><a><img src="assets/img/logo_TheMovieScope_HD.png" width="125" height="70"/></a></div>
    </div>


    <?php
    session_start();
    if ($_SESSION['admin'] == 1)
        echo '<a href="Admin.php?menu=artiste">Retour</a>';
    else
        echo '<a href="Internaute.php?menu=artiste">Retour</a>';
    $id = $_GET['id'];
    echo '<table id="table_artiste">';
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=cinema', 'root', '');
    }
    catch (Exception $e) {
        die('Erreur de connexion : ' . $e->getMessage());
    }
    $rep = $bdd->query('SELECT * FROM cinema.artiste WHERE idArtiste=' . $id . ';');
    while ( $donnee = $rep->fetch() ) {
        if ($donnee['image'] == null)
            $donnee['image'] = "assets/img/no_image_available.png";

        echo '<th><img height="200px" width="150px" src="' . $donnee['image'] . '">' .
            '<h2>' . $donnee['prenom'] . ' ' . $donnee['nom'] . '</h2>' .
            ' Date de naissance :' . $donnee['dateNaiss'] .
            '</th>';

        //Affichage des boutons pour l'admin
        if ($_SESSION['admin'] == 1) {
            echo '  <td><a href="Suppression.php?id=' . $donnee['idArtiste'] . '&genre=artiste"><button>Supprimer</button></a></td>
                <td><a href="Modification.php?id=' . $donnee['idArtiste'] . '&genre=artiste&nom=' . $donnee['nom'] . '&prenom=' . $donnee['prenom'] . '&date=' . $donnee['dateNaiss'] . '"><button>Modifier</button></a></td>';
        }
    }
    ?>
</nav>
</table>
</body>
</html>