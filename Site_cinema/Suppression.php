<?php
session_start();
if(isset($_GET['id']))
    $id = $_GET['id'];
else
    $id=NULL;

if(isset($_GET['genre']))
    $genre = $_GET['genre'];
else
    $genre=NULL;

if($genre=="film"){
//connexion bdd
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=cinema', 'root', '');
    } catch (Exception $e) {
        die('Erreur de connexion : ' . $e->getMessage());
    }
    //preparation de la requête avec les variables $_POST du formulaire
    $req = $bdd->prepare('DELETE FROM film WHERE (idFilm = ?);');
    $req->execute([$id]) or die(print_r($req->errorInfo()));
}

if($genre=="genre"){
//connexion bdd
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=cinema', 'root', '');
    } catch (Exception $e) {
        die('Erreur de connexion : ' . $e->getMessage());
    }
    //preparation de la requête avec les variables $_POST du formulaire
    $req = $bdd->prepare('DELETE FROM genre WHERE (idGenre = ?);');
    $req->execute([$id]) or die(print_r($req->errorInfo()));
}

if($genre=="internaute"){
//connexion bdd
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=cinema', 'root', '');
    } catch (Exception $e) {
        die('Erreur de connexion : ' . $e->getMessage());
    }
    $req = $bdd->prepare('DELETE FROM internaute WHERE (idInternaute = ?);');
    $req->execute([$id]) or die(print_r($req->errorInfo()));
}

if($genre=="artiste"){
//connexion bdd
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=cinema', 'root', '');
    } catch (Exception $e) {
        die('Erreur de connexion : ' . $e->getMessage());
    }
    $req = $bdd->prepare('DELETE FROM film WHERE (Artiste_idRealisateur = ?);');
    $req->execute([$id]) or die(print_r($req->errorInfo()));

    $requete = $bdd->prepare('DELETE FROM artiste WHERE (idArtiste = ?);');
    $requete->execute([$id]) or die(print_r($requete->errorInfo()));

}
   header('Location: Admin.php');