<?php
/*TODO Créer le compte utilisateur*/
echo($_POST['prenom']);


/*// debut de la session
session_start();
$console = $_POST['console'];
$nom = $_POST['nom'];
$commentaire = $_POST['commentaire'];
//connexion bdd
try {
    $bdd = new PDO('mysql:host=localhost;dbname=jointuredauvergneflorian', 'root', '');
} catch (Exception $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

try {
    $req = $bdd->prepare('INSERT INTO `jeux` (nom, console, commentaires) VALUES (:nom, :console, :commentaire);');
    $req->execute(array(
        'nom' => $nom,
        'console' => $console,
        'commentaire' => $commentaire,
    ));
} catch (Exception $e) {
    die('Erreur requête Ajout : ' . $e->getMessage());
}
$_SESSION['Ajout'] = 'OK';
header('Location: Admin.php');*/
