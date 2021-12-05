<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Nom du site</title>
    <script src="js/javascript.js"></script>
</head>

<body>
<div id="logo">
    <img src="">
    <h1>Nom du site</h1>
</div>
<button id="sign_button" onclick="sign()">S'inscrire</button>
<div id="connexion" style="display: block">

    <form action="Traitement.php" method="post">
        <table>
            <tr>
                <td><label for="login">Mail</label></td> <td><input type="text" name="login" id="login" /><br/></td>
            </tr>
            <tr>
                <td><label for="mdp">Mot de passe</label></td> <td><input type="password" name="mdp"  id="mdp"/><br/></td>
            </tr>
            <tr>
                <td></td> <td><input type="button" value="Se Connecter" onclick="VerifierLogin(this.form)"/></br></td>
            </tr>
        </table>
    </form>
</div>


<div id="inscription" style="display: none">
    <form action="Creation.php" method="post">
        <table>
            <tr>
                <td><label for="login">Mail</label></td> <td><input type="text" name="login" id="login" /></td>
            </tr>
            <tr>
                <td><label for="mdp">Mot de passe</label></td> <td><input type="password" name="mdp"  id="mdp"/></td>
            </tr>
            <tr>
                <td><label>Confirmation</label></td><td><input type="password" name="conf"  id="conf"/></td>
            </tr>

            <tr>
                <td><label for="mdp">Prénom</label></td> <td><input type="text" name="prenom"  id="prenom"/><br/></td>
            </tr>
            <tr>
                <td><label for="mdp">Nom</label></td> <td><input type="text" name="nom"  id="nom"/></td>
            </tr>
            <tr>
                <td></td> <td><input type="button" value="S'inscrire" onclick="VerifierInscription(this.form)"/></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>

<?php
