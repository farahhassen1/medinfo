function validateForm() {
    var date = document.getElementById("date").value;
    var heure = document.getElementById("heure").value;
    var commentaire=document.getElementById("commentaire").value;

    var dateError = document.getElementById("dateError");
    var heureError = document.getElementById("heureError");
    var commentaireError = document.getElementById("commentaireError");
    dateError.innerHTML = "";
    heureError.innerHTML = "";
    commentaireError.innerHTML = "";
    var isValid = true;

    if (!date) {
        dateError.innerHTML = "La date ne peut pas être vide.";
        isValid = false;
    }

    if (!heure) {
        heureError.innerHTML = "L'heure ne peut pas être vide.";
        isValid = false;
    }
    if (!commentaire) {
        commentaireError.innerHTML = "Le commentaire ne peut pas être vide.";
        isValid = false;
    }
    var datePubObj = new Date(date);
    var dateDebut = new Date('12/01/2023');
    var dateFin = new Date('12/31/2024');

    if (datePubObj < dateDebut || datePubObj > dateFin) 
    {
        dateError.innerHTML = 'La date de rendez-vous doit être entre le 1/12/2023 et le 31/12/2024';
        return false;
    }
    return isValid;
}
function validerFormulaire2() 
{
    var commentaire= document.getElementById('commentaire').value;
    var date = document.getElementById('date').value;

    // Vérifier que les champs ne sont pas vides
    if (date.trim() === '' || commentaire.trim() === '' )
    {
        alert('Veuillez remplir tous les champs.');
        return false;
    }
var datePubObj = new Date(date);
var dateDebut = new Date('12/01/2023');
var dateFin = new Date('12/31/2024');

if (datePubObj < dateDebut || datePubObj > dateFin) 
{
    alert('La date de rendez-vous doit être entre le 1/12/2023 et le 31/12/2024.');
    return false;
}
    return true;
}