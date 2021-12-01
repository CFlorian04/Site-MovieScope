

//Verification du Login
function VerifierLogin(formulaire){
    if (formulaire.login.value=="" || formulaire.mdp.value==""){
        alert ("Veuillez renseigner le login et le mdp !");
    }
    else{
        formulaire.submit();
    }
}
//Verification de l'inscription
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



function sign() {
    inscription = document.getElementById("inscription");
    connexion = document.getElementById("connexion");
    bouton = document.getElementById("sign_button");

    if(bouton.firstChild.data == "S'inscrire")
    {
        inscription.setAttribute("style","display:block");
        connexion.setAttribute("style","display:none");
        bouton.firstChild.data = "Se Connecter";
    }
    else if(bouton.firstChild.data == "Se Connecter")
    {
        inscription.setAttribute("style","display:none");
        connexion.setAttribute("style","display:block");
        bouton.firstChild.data = "S'inscrire";
    }
}
