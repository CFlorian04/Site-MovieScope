<<<<<<< Updated upstream
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
if($_GET['genre']==="film"){
    $titre=$_GET['film'];
    $date=$_GET['date'];
    $genre=$_GET['type'];
    $artiste=$_GET['artiste'];
    $resume=utf8_encode(urldecode($_GET['resume']));


    echo '<div>
    <form action="Modification.php?id='.$id.'&genre=film" method="post" accept-charset="UTF-8">
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
        if($donnee['libelle']==$genre)
            $selected="selected";
        else
            $selected="";
        echo('<option name="genre"'.$selected.' value="'.$donnee['idGenre'].'">'.$donnee['libelle'].'</option>');
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
        if($donnee['prenom'].' '.$donnee['nom']==$artiste)
            $selected="selected";
        else
            $selected="";
        echo('<option name="artiste"'.$selected.' value="'.$donnee['idArtiste'].'">'.$donnee['prenom'].' '.$donnee['nom'].'</option>');
    }
    echo'</select></td>
            </tr>
            
            </tr>
        </table>Résumé</br>
        <textarea name="resume" rows="4" cols="50">'.$resume.'</textarea></br>
        <input type="button" value="Modifier" onclick="this.form.submit()">
    </form>
</div></body></html>';
    if(isset($_POST['titre'])&&isset($_POST['annee'])){
        $titre=$_POST['titre'];
        $annee=$_POST['annee'];
        $Artiste=$_POST['artiste'];
        $Genre=$_POST['genre'];
        $resume=utf8_decode($_POST['resume']);
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
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($_GET['genre']==="genre"){
    $libelle=$_GET['libelle'];
    echo'
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
        header('Location: Admin.php');
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($_GET['genre']==="artiste"){
    $nom=$_GET['nom'];
    $date=$_GET['date'];
    $prenom=$_GET['prenom'];
    echo'<div>
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
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=cinema', 'root', '');
            } catch (Exception $e) {
                die('Erreur de connexion : ' . $e->getMessage());
            }
            $req = $bdd->prepare('UPDATE artiste SET nom = ?, prenom = ?, dateNaiss = ? WHERE (`idArtiste` = ?);');
            $req->execute([$nom,$prenom,$date,$id]) or die(print_r($req->errorInfo()));
            header('Location: Admin.php');
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($_GET['genre']==="internautes"){
    $nom=$_GET['nom'];
    $prenom=$_GET['prenom'];
    $admin=$_GET['admin'];

    if($admin=="0")
        $selected="checked";
    else
        $selected="";

    echo'<div>
    <form action="Modification.php?id='.$id.'&genre=internautes" method="post">
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
                <td><label>Statut admin</label></td>
                 
                <td>
                <input type="radio" name="admin" value="1" checked><label>Admin</label>
                <input type="radio" name="admin" value="0" '.$selected.'><label>Internaute</label>
                </td>
            </tr>
            <td><input type="button" value="Modifier" onclick="this.form.submit()"></td>
            </tr>
        </table>
    </form>
</div></body></html>';
    if(isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['admin'])){
        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
        $admin=$_POST['admin'];
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=cinema', 'root', '');
        } catch (Exception $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
        $req = $bdd->prepare('UPDATE internaute SET nom = ?, prenom = ?, admin = ? WHERE (`idInternaute` = ?);');
        $req->execute([$nom,$prenom,$admin,$id]) or die(print_r($req->errorInfo()));
        header('Location: Admin.php');
    }
}
?>
=======
<?php
session_start();
if(isset($_SESSION['admin'])){
    if ($_SESSION['admin'] == 0 ) {
        header('location:Internaute.php');
    }}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nom du site</title>
</head>
<body>
<?php
try{
    $bdd = new PDO('mysql:host=localhost;dbname=cinema','root','');
}
catch(Exception $e){die('Erreur de connexion : '.$e->getMessage());}

$id=$_GET['id'];
if($_GET['genre']==="film"){
    $titre=$_GET['film'];
    $date=$_GET['date'];
    $genre=$_GET['type'];
    $artiste=$_GET['artiste'];
    $image=$_GET['image'];
    $resume=utf8_encode(urldecode($_GET['resume']));
    echo'<a href="Film.php?id='.$id.'">Retour</a>';

    echo '<div>
    <form action="Modification.php?id='.$id.'&genre=film" method="post" accept-charset="UTF-8">
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
    $rep = $bdd->query('SELECT * FROM cinema.genre;');
    while($donnee = $rep->fetch())
    {
        if($donnee['libelle']==$genre)
            $selected="selected";
        else
            $selected="";
        echo('<option name="genre"'.$selected.' value="'.$donnee['idGenre'].'">'.$donnee['libelle'].'</option>');
    }

    echo'</select></td>
            </tr>
            <tr>
                <td><label>Artiste</label></td>
                <td ><select name="artiste">';

    $rep = $bdd->query('SELECT * FROM cinema.artiste;');
    while($donnee = $rep->fetch())
    {
        if($donnee['prenom'].' '.$donnee['nom']==$artiste)
            $selected="selected";
        else
            $selected="";
        echo('<option name="artiste"'.$selected.' value="'.$donnee['idArtiste'].'">'.$donnee['prenom'].' '.$donnee['nom'].'</option>');
    }
    echo'</select></td>
            </tr>
        </table>Résumé</br>
        <textarea name="resume" rows="4" cols="50">'.$resume.'</textarea></br>
         Image :<td><input type="url" value="'.$image.'" name="image"></td>
        <input type="button" value="Modifier" onclick="this.form.submit()">
    </form>
</div></body></html>';
    if(isset($_POST['titre'])&&isset($_POST['annee'])){
        $titre=$_POST['titre'];
        $annee=$_POST['annee'];
        $Artiste=$_POST['artiste'];
        $Genre=$_POST['genre'];
        $image=$_POST['image'];
        $resume=utf8_decode($_POST['resume']);
            $req = $bdd->prepare('UPDATE film SET titre = ?, annee = ?, Artiste_idRealisateur = ?, Genre_idGenre = ?,resume=?,image=? WHERE (idFilm = ?);');
            $req->execute([$titre,$annee,$Artiste,$Genre,$resume,$image,$id]) or die(print_r($req->errorInfo()));
            header('Location: Film.php?id='.$id.'');
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($_GET['genre']==="genre"){
    $libelle=$_GET['libelle'];
    echo'
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
        $req = $bdd->prepare('UPDATE genre SET libelle = ? WHERE (idGenre = ?);');
        $req->execute([$libelle,$id]) or die(print_r($req->errorInfo()));
        header('Location: Admin.php?menu=genre');
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($_GET['genre']==="artiste"){
    $nom=$_GET['nom'];
    $date=$_GET['date'];
    $prenom=$_GET['prenom'];
    echo'<a href="Artistes.php?id='.$id.'">Retour</a>';
    echo'<div>
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
            $req = $bdd->prepare('UPDATE artiste SET nom = ?, prenom = ?, dateNaiss = ? WHERE (`idArtiste` = ?);');
            $req->execute([$nom,$prenom,$date,$id]) or die(print_r($req->errorInfo()));
            header('Location: Admin.php?menu=artiste');
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($_GET['genre']==="internautes"){
    $nom=$_GET['nom'];
    $prenom=$_GET['prenom'];
    $admin=$_GET['admin'];

    if($admin=="0")
        $selected="checked";
    else
        $selected="";

    echo'<div>
    <form action="Modification.php?id='.$id.'&genre=internautes" method="post">
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
                <td><label>Statut admin</label></td>
                 
                <td>
                <input type="radio" name="admin" value="1" checked><label>Admin</label>
                <input type="radio" name="admin" value="0" '.$selected.'><label>Internaute</label>
                </td>
            </tr>
            <td><input type="button" value="Modifier" onclick="this.form.submit()"></td>
            </tr>
        </table>
    </form>
</div></body></html>';
    if(isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['admin'])){
        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
        $admin=$_POST['admin'];
        $req = $bdd->prepare('UPDATE internaute SET nom = ?, prenom = ?, admin = ? WHERE (`idInternaute` = ?);');
        $req->execute([$nom,$prenom,$admin,$id]) or die(print_r($req->errorInfo()));
        header('Location: Admin.php?menu=internaute');
    }
}
?>
>>>>>>> Stashed changes
