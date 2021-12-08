<?php

session_start();

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Nom du site</title>
</head>
<body>
<a href="Admin.php">Retour</a>
<?php

echo'<div>
    <form action="Profil.php" method="post">
        <table>
            <tr>
                <td><label>Nom</label></td>
                <td ><input name="nom" value="'.$_SESSION['donnee']['nom'].'"></td>
            </tr>
            <tr>
                <td><label>Prenom</label></td>
                <td ><input name="prenom" value="'.$_SESSION['donnee']['prenom'].'"></td>
            </tr>
            <tr>
                <td><label>Mot de Passe</label></td>
                <td ><input type="password" name="password" value="'.$_SESSION['donnee']['password'].'"></td>
            </tr>
            
            <td><input type="button" value="Modifier" onclick="this.form.submit()"></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>';


if(isset($_POST['nom'])&&isset($_POST['prenom'])){
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $id=$_SESSION['donnee']['idInternaute'];
    $password=$_POST['password'];
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=cinema', 'root', '');
    } catch (Exception $e) {
        die('Erreur de connexion : ' . $e->getMessage());
    }
    $req = $bdd->prepare('UPDATE internaute SET prenom = ?, nom = ?, password = ? WHERE idInternaute = ?;');
    $req->execute([$prenom,$nom,$password,$id]) or die(print_r($req->errorInfo()));
    header('Location: Admin.php');}
