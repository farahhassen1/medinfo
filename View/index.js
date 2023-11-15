function validerDate(){
    var date = document.getElementById('date')
    if( date.value < "2024-04-30" || date.value > "2023-11-01" ){
        alert("Date invalide")
    } else {
        alert("Date valide")
    }
}
const validerButton = document.getElementById("validerButton");
validerButton.onclick = function() {
  const dateInputValue = document.getElementById("date").value;
  validerDate(dateInputValue);
};
function validerHeure() {
    var heure = document.getElementById('heure').value;

    // Vous pouvez ajuster ces valeurs selon vos besoins
    var heureMin = "08:00";
    var heureMax = "18:00";

    if (heure < heureMin || heure > heureMax) {
        alert("Heure invalide");
    } else {
        alert("Heure valide");
    }
}

const validerButtonHeure = document.getElementById("validerButton  ");
validerButtonHeure.onclick = function() {
    validerHeure();
};
