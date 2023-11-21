 function validerDate() {
    var date = document.getElementById('date').value;
    var montant = document.getElementById('montant').value;
    var descreption = document.getElementById('descreption').value;

    if (date < "2024-01-01" || date > "2024-12-31") {
        alert("Date invalide");
        return false;
    } 

    if (montant === '' ||descreption ==='') {
        alert("Veuillez remplir tous les champs");
        return false;
    }

    // Si toutes les validations passent, retourne true
    return true;
}




