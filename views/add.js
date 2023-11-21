function valider()
{
    var nom = document.getElementById("nom_medicament").value;
    var fabricant= document.getElementById("fabricant").value;
    
    for (var i = 0; i < nom.length; i++) {
        if (isNaN(nom[i]) && !/[a-zA-Z]/.test(nom[i])) {
            alert("Nom non valide");
            return false;
        }
    }

    for (var i = 0; i < fabricant.length; i++) {
        if (isNaN(fabricant[i]) && !/[a-zA-Z]/.test(fabricant[i])) {
            alert("fabricant non valide");
            return false;
        }
    }
}