<?php
session_start();

$email = $_POST['login'];
$password = $_POST['mdp'];

//connexion bdd
try{$bdd = new PDO('mysql:host=localhost;dbname=cinema','root','');}
catch(Exception $e){die('Erreur de connexion : '.$e->getMessage());}

//preparation de la requête avec les variables $_POST du formulaire
$req = $bdd -> prepare('SELECT * FROM internaute WHERE password=:password AND email=:email');
$req->execute(array('password' => $password,'email' => $email)) or die(print_r($req->errorInfo()));

$donnee = $req->fetch();
$req->closeCursor();

switch($donnee['admin']){

    case '1' 	:	//Redirection vers admin.php avec variable $_SESSION['who']='admin'
        $_SESSION['admin']=1;
        $_SESSION['nom']= $donnee['nom'];
        header('Location: Admin.php');
        break;

    case '0'		:	//Redirection vers index.php avec variable $_SESSION['who']='moh'
        $_SESSION['admin']=0;
        $_SESSION['nom']= $donnee['nom'];
        header('Location: Internaute.php');
        break;

    default			:	//Redirection vers index.php avec variable $_SESSION['who']='default'
        $_SESSION['nom']='';
        header('Location: Index.php');
        break;
}
?>