function validerFormulaire() 
{
    // Récupérer les valeurs des champs
    var commentaire= document.getElementById('commentaire').value;
    var heure = document.getElementById('heure').value;
    var date = document.getElementById('date').value;

    // Vérifier que les champs ne sont pas vides
    if (date.trim() === '' || heure.trim() === '' || commentaire.trim() === '' )
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
