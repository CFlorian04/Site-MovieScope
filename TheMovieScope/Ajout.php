<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <title>Nom du site</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>

<body>



<nav>
    <div class="navbar">
        <div class="logo"><a>TheMovieScope</a></div>
        <div class="nav-links">
            <ul class="links">
                <li><a href="Admin.php">Retour</a></li>
                <li><a href="Profil.php">Profil</a></li>
                <li><a href="Index.php">Déconnexion</a></li>
            </ul>
        </div>
        <div class="logo"><a><img src="assets/img/logo_TheMovieScope_HD.png" width="125" height="70" /></a></div>
    </div>



<div id="modif_div">

<?php
if($_GET['action']==="film"){echo '<div>
    <form action="Ajout.php?action=film" method="post">
        <table>
            <tr>
                <td><label>Titre</label></td> <td><input type="text" name="titre"/></td>
            </tr>
            <tr>
                <td><label>Annee</label></td> <td><input type="text" name="annee"/></td>
            </tr>
            <tr>
                <td><label>Genre</label></td>
                <td ><select name="genre">';

    try{
        $bdd = new PDO('mysql:host=localhost;dbname=cinema','root','');
    }
    catch(Exception $e){
        die('Erreur de connexion : '.$e->getMessage());}
    $rep = $bdd->query('SELECT * FROM cinema.genre;');
    while($donnee = $rep->fetch())
    {
        echo('<option name="genre" value="'.$donnee['idGenre'].'">'.$donnee['libelle'].'</option>');
    }
    echo'</select></td>
            </tr>

            <tr>
                <td><label>Artiste</label></td>
                <td ><select name="artiste">';

    try{
        $bdd = new PDO('mysql:host=localhost;dbname=cinema','root','');
    }
    catch(Exception $e){
        die('Erreur de connexion : '.$e->getMessage());}
    $rep = $bdd->query('SELECT * FROM cinema.artiste;');
    while($donnee = $rep->fetch())
    {
        echo('<option name="artiste" value="'.$donnee['idArtiste'].'">'.$donnee['prenom'].' '.$donnee['nom'].'</option>');
    }
    echo'</select></td>
        
                    </tr>
                    <td><label>Résumé</label></td><td><input name="resume" rows="3" cols="50"></textarea></td>
                    <td><label>Image</label></td><td><input type="url" placeholder="URL" name="image"></td>
                <td><input type="button" value="Ajouter" onclick="this.form.submit()"></td>
            </tr>
        </table>
    </form>
</div></body></html>';
    if(isset($_POST['titre'])&&isset($_POST['annee'])){
        $titre=$_POST['titre'];
        $annee=$_POST['annee'];
        $Artiste=$_POST['artiste'];;
        $Genre=$_POST['genre'];
        $resume=$_POST['resume'];
        $image=$_POST['image'];
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=cinema', 'root', '');
            } catch (Exception $e) {
                die('Erreur de connexion : ' . $e->getMessage());
            }
//preparation de la requête avec les variables $_POST du formulaire
            $req = $bdd->prepare('INSERT INTO film (titre, annee,resume, Artiste_idRealisateur, Genre_idGenre,image) VALUES (?,?,?,?,?,?);');
            $req->execute([$titre,$annee,$resume,$Artiste,$Genre,$image]) or die(print_r($req->errorInfo()));
            header('Location: Admin.php?menu=film');
        }
}

if($_GET['action']==="genre"){echo'
<div>
    <form action="Ajout.php?action=genre" method="post">
        <table>
            <tr>
                <td><label>Libelle</label></td>
                <td ><input name="libelle"></td>
            </tr>
                <td><input type="button" value="Ajouter" onclick="this.form.submit()"></td>
            </tr>
        </table>
    </form>
</div>';
if(isset($_POST['libelle'])){
        $libelle=$_POST['libelle'];
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=cinema', 'root', '');
            } catch (Exception $e) {
                die('Erreur de connexion : ' . $e->getMessage());
            }
//preparation de la requête avec les variables $_POST du formulaire
            $req = $bdd->prepare('INSERT INTO genre (libelle) VALUES (?);');
            $req->execute([$libelle]) or die(print_r($req->errorInfo()));
            header('Location: Admin.php?menu=genre');
}
}

if($_GET['action']==="artiste"){echo'<div>
    <form action="Ajout.php?action=artiste" method="post">
        <table>
            <tr>
                <td><label>Nom</label></td>
                <td ><input name="nom"></td>
            </tr>
            <tr>
                <td><label>Prenom</label></td>
                <td ><input name="prenom"></td>
            </tr>
            <tr>
                <td><label>Date de naissance</label></td>
                <td ><input name="date" type="date"></td>
            </tr>
            <td><input type="button" value="Ajouter" onclick="this.form.submit()"></td>
            </tr>
        </table>
    </form>
</div>';
if(isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['date'])){

    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $date=$_POST['date'];
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=cinema', 'root', '');
        } catch (Exception $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
//preparation de la requête avec les variables $_POST du formulaire
        $req = $bdd->prepare('INSERT INTO artiste (nom,prenom,dateNaiss) VALUES (?,?,?);');
        $req->execute([$nom,$prenom,$date]) or die(print_r($req->errorInfo()));
        header('Location: Admin.php?menu=artiste');
    }
}
?>

</div>
</nav>
</body>
</html>
