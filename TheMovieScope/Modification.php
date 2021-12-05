<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Nom du site</title>
</head>

<body>
<a href="Admin.php">Retour</a>
<?php
$id=$_GET['id'];
if(isset($_GET['nom'])&&isset($_GET['date'])&&isset($_GET['prenom'])){
$nom=$_GET['nom'];
$date=$_GET['date'];
$prenom=$_GET['prenom'];
}
$resume=urldecode($_GET['resume']);
if(isset($_GET['film'])&&isset($_GET['date'])&&isset($_GET['type'])&&isset($_GET['artiste'])){
    $titre=$_GET['film'];
    $date=$_GET['date'];
    $genre=$_GET['type'];
    $artiste=$_GET['artiste'];
}
if(isset($_GET['libelle']))
    $libelle=$_GET['libelle'];

if($_GET['genre']==="film"){echo '<div>
    <form action="Modification.php?id='.$id.'&film='.$titre.'&genre=film&date='.$date.'&resume='.$resume.'" method="post">
        <table>
            <tr>
                <td><label>Titre</label></td> <td><input type="text" name="titre" value="'.$titre.'"/></td>
            </tr>
            <tr>
                <td><label>Annee</label></td> <td><input type="text" name="annee" value="'.$date.'"/></td>
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
    echo'</select>Ancien: '.$genre.'</td>
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
    echo'</select>Ancien: '.$artiste.'</td>
            </tr>
            <textarea name="resume" rows="4" cols="50">'.utf8_encode($resume).'</textarea>
                <tr><td><input type="button" value="Modifier" onclick="this.form.submit()"></td></tr>
            </tr>
        </table>
    </form>
</div></body></html>';
    if(isset($_POST['titre'])&&isset($_POST['annee'])){
        $titre=$_POST['titre'];
        $annee=$_POST['annee'];
        $Artiste=$_POST['artiste'];
        $Genre=$_POST['genre'];
        $resume=$_POST['resume'];
        if($titre!=""||$annee!=""){
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=cinema', 'root', '');
            } catch (Exception $e) {
                die('Erreur de connexion : ' . $e->getMessage());
            }
//preparation de la requête avec les variables $_POST du formulaire
            $req = $bdd->prepare('UPDATE film SET titre = ?, annee = ?, Artiste_idRealisateur = ?, Genre_idGenre = ?,resume=? WHERE (idFilm = ?);');
            $req->execute([$titre,$annee,$Artiste,$Genre,$resume,$id]) or die(print_r($req->errorInfo()));
            header('Location: Admin.php');
        }
    }
}

if($_GET['genre']==="genre"){echo'
<div>
    <form action="Modification.php?id='.$id.'&genre=genre" method="post">
        <table>
            <tr>
                <td><label>Libelle</label></td>
                <td ><input name="libelle" value="'.$libelle.'"></td>
            </tr>
                <td><input type="button" value="Modifier" onclick="this.form.submit()"></td>
            </tr>
        </table>
    </form>
</div></body></html>';
    if(isset($_POST['libelle'])){
        $libelle=$_POST['libelle'];
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=cinema', 'root', '');
        } catch (Exception $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
//preparation de la requête avec les variables $_POST du formulaire
        $req = $bdd->prepare('UPDATE genre SET libelle = ? WHERE (idGenre = ?);');
        $req->execute([$libelle,$id]) or die(print_r($req->errorInfo()));
        header('Location: Admin.php');}
}

if($_GET['genre']==="artiste"){echo'<div>
    <form action="Modification.php?id='.$id.'&genre=artiste" method="post">
        <table>
            <tr>
                <td><label>Nom</label></td>
                <td ><input name="nom" value="'.$nom.'"></td>
            </tr>
            <tr>
                <td><label>Prenom</label></td>
                <td ><input name="prenom" value="'.$prenom.'"></td>
            </tr>
            <tr>
                <td><label>Date de naissance</label></td>
                <td ><input name="date" type="date" value="'.$date.'"></td>
            </tr>
            <td><input type="button" value="Modifier" onclick="this.form.submit()"></td>
            </tr>
        </table>
    </form>
</div></body></html>';
    if(isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['date'])){

        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
        $date=$_POST['date'];

        if($nom!=""&&$prenom!=""){
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=cinema', 'root', '');
            } catch (Exception $e) {
                die('Erreur de connexion : ' . $e->getMessage());
            }
//preparation de la requête avec les variables $_POST du formulaire
            $req = $bdd->prepare('UPDATE artiste SET nom = ?, prenom = ?, dateNaiss = ? WHERE (`idArtiste` = ?);');
            $req->execute([$nom,$prenom,$date,$id]) or die(print_r($req->errorInfo()));
            header('Location: Admin.php');
        }
    }
}
?>
