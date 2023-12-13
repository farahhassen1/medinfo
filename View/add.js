// Validation for medical name
function validateName() {
    var nom = document.getElementById("nom_medicament").value.trim();
    var name_error = document.getElementById("erreurNom");

    if (nom === "") {
        name_error.style.color = "red";
        name_error.textContent = "The medical name is obligatory ✖";
    } else if (!/^[a-zA-Z0-9\s]+$/.test(nom)) {
        name_error.style.color = "red";
        name_error.textContent = "Please enter only letters and numbers ✖";
    } else {
        name_error.style.color = "green";
        name_error.textContent = "Correct ✔";
    }
}

// Validation for fabricant ID
function validateFabricant() {
    var id_fabricant = document.getElementById("id_fabricant").value;
    var fabricant_error = document.getElementById("erreurFabricant");

    if (id_fabricant === 'Select a fabricant') {
        fabricant_error.style.color = "red";
        fabricant_error.textContent = "The fabricant ID is obligatory ✖";
    } else {
        fabricant_error.style.color = "green";
        fabricant_error.textContent = "Correct ✔";
    }
}

// Validation for expiration date
function validateDate() {
    var date = document.getElementById("date_prescription").value.trim();
    var date_error = document.getElementById("erreurdate");

    if (date === "") {
        date_error.style.color = "red";
        date_error.textContent = "The date of expiration is obligatory ✖";
    } else {
        date_error.style.color = "green";
        date_error.textContent = "Correct ✔";
    }
}

// Attach event listeners to validate inputs as the user interacts
document.getElementById("nom_medicament").addEventListener('input', validateName);
document.getElementById("id_fabricant").addEventListener('change', validateFabricant);
document.getElementById("date_prescription").addEventListener('input', validateDate);

// Validate the form before submission
document.getElementById("compile").addEventListener('submit', function(event) {
    validateName();
    validateFabricant();
    validateDate();

    var name_error = document.getElementById("erreurNom");
    var fabricant_error = document.getElementById("erreurFabricant");
    var date_error = document.getElementById("erreurdate");

    if (name_error.textContent !== "Correct ✔" || 
        fabricant_error.textContent !== "Correct ✔" || 
        date_error.textContent !== "Correct ✔") {
        event.preventDefault(); // Prevent form submission if there are errors
    }
});

function clearErrors() {
    document.getElementById("erreurNom").textContent = "";
    document.getElementById("erreurFabricant").textContent = "";
    document.getElementById("erreurdate").textContent = "";
}
