<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Nom du site</title>
</head>

<body>
<a href="Admin.php">Retour</a>
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
        if($titre!=""||$annee!=""){
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=cinema', 'root', '');
            } catch (Exception $e) {
                die('Erreur de connexion : ' . $e->getMessage());
            }
//preparation de la requête avec les variables $_POST du formulaire
            $req = $bdd->prepare('INSERT INTO film (titre, annee, Artiste_idRealisateur, Genre_idGenre) VALUES (?,?, ?,?);');
            $req->execute([$titre,$annee,$Artiste,$Genre]) or die(print_r($req->errorInfo()));
            header('Location: Admin.php');
        }
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
</div></body></html>';
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
            header('Location: Admin.php');}
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
        $req = $bdd->prepare('INSERT INTO artiste (nom,prenom,dateNaiss) VALUES (?,?,?);');
        $req->execute([$nom,$prenom,$date]) or die(print_r($req->errorInfo()));
        header('Location: Admin.php');
    }
}}
?>