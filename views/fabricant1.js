
function validateName() {
    var nom = document.getElementById("nom_fabricant").value.trim();
    var name_error = document.getElementById("erreurNom");

    if (nom === "") {
        name_error.style.color = "red";
        name_error.textContent = "The fabricant name is obligatory ✖";
    } else if (!/^[a-zA-Z0-9\s]+$/.test(nom)) {
        name_error.style.color = "red";
        name_error.textContent = "Please enter only letters and numbers ✖";
    } else {
        name_error.style.color = "green";
        name_error.textContent = "Correct ✔";
    }
}


function validateAdress() {
    var adress = document.getElementById("adress_fabricant").value.trim();
    var adress_error = document.getElementById("erreurAdress");

    if (adress === "") {
        adress_error.style.color = "red";
        adress_error.textContent = "The Adress is obligatory ✖";
    } else if (!/^[a-zA-Z0-9,\s]+$/.test(adress)) {
        adress_error.style.color = "red";
        adress_error.textContent = "Please enter only letters and numbers ✖";
    } else {
        adress_error.style.color = "green";
        adress_error.textContent = "Correct ✔";
    }
}


function validateContact() {
    var contact = document.getElementById("contact").value.trim();
    var contact_error = document.getElementById("erreurContact");

    if (contact === "") {
        contact_error.style.color = "red";
        contact_error.textContent = "The Contact is obligatory ✖";
    } else {
        contact_error.style.color = "green";
        contact_error.textContent = "Correct ✔";
    }
}


document.getElementById("nom_fabricant").addEventListener('input', validateName);
document.getElementById("adress_fabricant").addEventListener('change', validateAdress);
document.getElementById("contact").addEventListener('input', validateContact);

document.getElementById("compile").addEventListener('submit', function(event) {
    validateName();
    validateAdress();
    validateContact();

    var name_error = document.getElementById("erreurNom");
    var adress_error = document.getElementById("erreurAdress");
    var contact_error = document.getElementById("erreurContact");

    if (name_error.textContent !== "Correct ✔" || 
        adress_error.textContent !== "Correct ✔" || 
        contact_error.textContent !== "Correct ✔") {
        event.preventDefault();
    }
});

function clearErrors() {
    document.getElementById("erreurNom").textContent = "";
    document.getElementById("erreurAdress").textContent = "";
    document.getElementById("erreurContact").textContent = "";
}
