<?php


session_start();

$email = $_POST['login'];
$password = $_POST['mdp'];
$prenom = $_POST['prenom'];
$nom = $_POST['nom'];

echo 'email = '. $email .'password = '. $password.'prenom = '. $prenom.'nom = '. $nom;

//connexion bdd
try{$bdd = new PDO('mysql:host=localhost;dbname=cinema','root','');}
catch(Exception $e){die('Erreur de connexion : '.$e->getMessage());}

//preparation de la requête avec les variables $_POST du formulaire
$req = $bdd -> prepare('SELECT email FROM internaute WHERE email=:email');
$req->execute(array('email' => $email)) or die(print_r($req->errorInfo()));

$donnee = $req->fetch();
$req->closeCursor();

if($donnee['email'] == $email)
{
    $_SESSION['nom']='';
    header('Location: Index.php');
}
else
{
    //connexion bdd
    try{$bdd = new PDO('mysql:host=localhost;dbname=cinema','root','');}
    catch(Exception $e){die('Erreur de connexion : '.$e->getMessage());}

    //preparation de la requête avec les variables $_POST du formulaire
    $req = $bdd -> prepare('INSERT INTO internaute (prenom,nom,email,password,admin) VALUES (?, ?, ?, ?, 0)');
    $req->execute([$prenom,$nom,$email,$password]) or die(print_r($req->errorInfo()));

    $_SESSION['admin']=false;
    $_SESSION['nom']= $nom;
    header('Location: Internaute.php');
}


?>