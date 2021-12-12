<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nom du site</title>
</head>
<body>
<?php
session_start();
try{
    $bdd = new PDO('mysql:host=localhost;dbname=cinema','root','');
}
catch(Exception $e){die('Erreur de connexion : '.$e->getMessage());}

$id=$_GET['id'];
echo'<a href="Film.php?id='.$id.'">Retour</a>';

echo '<div>
    <form action="Noter.php?id='.$id.'" method="post" accept-charset="UTF-8">
        Mon commentaire</br>
        <textarea name="commentaire" rows="4" cols="50"></textarea></br>
          </select></td>
            </tr>
            <tr>
                <td><label>Note</label></td>
                <td ><select name="note">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
          </select></td>
            </tr>
        <input type="button" value="Poster" onclick="this.form.submit()">
    </form>
</div></body></html>';
$user=$_SESSION['donnee']['idInternaute'];
if(isset($_POST['commentaire'])){
    $commentaire=utf8_decode($_POST['commentaire']);
    $note=$_POST['note'];
    $req = $bdd->prepare('INSERT IGNORE INTO cinema.noter(Internaute_idInternaute,Film_idFilm,note,commentaire) VALUES (?, ?, ?,?)');
    $req->execute([$user,$id,$note,$commentaire]) or die(print_r($req->errorInfo()));
    header('Location: Film.php?id='.$id.'');
}