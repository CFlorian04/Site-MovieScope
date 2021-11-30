<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nom du site</title>
</head>
<body>
<div id="Connexion">
    <h1>Nom du site</h1>
    <form action="traitementConnexion.php" method="post">
        <table>
            <th>Se connecter</th>
            <tr>
                <td><label for="login">Mail</label></td> <td><input type="text" name="login" id="login" /><br/></td>
            </tr>
            <tr>
                <td><label for="mdp">Mot de passe</label></td> <td><input type="password" name="mdp"  id="mdp"/><br/></td>
            </tr>
            <tr>
                <td></td> <td><input type="button" value="envoyer" onclick="VerifierLogin(this.form)"/></br></td>
            </tr>
        </table>
    </form>
</div>


<div id="Connexion">
    <form action="traitementConnexion.php" method="post">
        <table>
            <th>S'inscrire</th>
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
                <td></td> <td><input type="button" value="envoyer" onclick="VerifierInscription(this.form)"/></td>
            </tr>
        </table>
    </form>
</div>
<script>
    function VerifierLogin(formulaire){
        if (formulaire.login.value=="" || formulaire.mdp.value==""){
            alert ("Veuillez renseigner le login et le mdp !");
        }
        else{
            formulaire.submit();
        }
    }

    function VerifierInscription(formulaire){
        if (formulaire.login.value==""){
            alert ("Veuillez renseigner un login ");
        }

        if (formulaire.mdp.value==""){
            alert ("Veuillez renseigner un mdp !");
        }

        if(formulaire.mdp.value!=formulaire.conf.value){
            alert ("Les mots de passe ne correspondent pas !");
        }

        if (formulaire.prenom.value==""){
            alert ("Veuillez renseigner un prénom !");
        }

        if (formulaire.nom.value==""){
            alert ("Veuillez renseigner un nom !");
        }
        else if(formulaire.login.value!=""&&formulaire.mdp.value!=""&&formulaire.prenom.value!=""&&formulaire.nom.value!=""&&formulaire.mdp.value==formulaire.conf.value){
            formulaire.submit();
        }
    }
</script>
</body>
</html>

<?php
