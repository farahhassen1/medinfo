// Validation for montant
function validerMontant() {
    var montant = document.getElementById("montant").value.trim();
    var montant_error = document.getElementById("erreurMontant");

    if (montant === "") {
        montant_error.style.color = "red";
        montant_error.textContent = "The montant is obligatory ✖";
    } else if (!/^[0-9]+$/.test(montant)) {
        montant_error.style.color = "red";
        montant_error.textContent = "Please enter only numbers ✖";
    } else {
        montant_error.style.color = "green";
        montant_error.textContent = "Correct ✔";
    }
}

// Validation for description
function validerDescription() {
    var description = document.getElementById("descreption").value.trim();
    var description_error = document.getElementById("erreurDescription");

    if (description === "") {
        description_error.style.color = "red";
        description_error.textContent = "The description is obligatory ✖";
    } else if (!/^[a-zA-Z\s]+$/.test(description)) {
        description_error.style.color = "red";
        description_error.textContent = "Please enter only letters and spaces ✖";
    } else {
        description_error.style.color = "green";
        description_error.textContent = "Correct ✔";
    }
}

// Validation for date
function validerDate() {
    var dateInput = document.getElementById("date").value;
    var date_error = document.getElementById("erreurDate");
    
    var selectedDate = new Date(dateInput);
    var startDate = new Date("2024-01-01");
    var endDate = new Date("2024-12-31");

    if (dateInput === "") {
        date_error.style.color = "red";
        date_error.textContent = "The date is obligatory ✖";
    } else if (isNaN(selectedDate.getTime())) {
        date_error.style.color = "red";
        date_error.textContent = "Invalid date format ✖";
    } else if (selectedDate < startDate || selectedDate > endDate) {
        date_error.style.color = "red";
        date_error.textContent = "Date must be between 1/1/2024 and 31/12/2024 ✖";
    } else {
        date_error.style.color = "green";
        date_error.textContent = "Correct ✔";
    }
}

// Attach event listeners to validate inputs as the user interacts
document.getElementById("montant").addEventListener('input', validerMontant);
document.getElementById("descreption").addEventListener('input', validerDescription);
document.getElementById("date").addEventListener('input', validerDate);

// Validate the form before submission
document.getElementById("myForm").addEventListener('submit', function (event) {
    validerMontant();
    validerDescription();
    validerDate();

    var montant_error = document.getElementById("erreurMontant");
    var description_error = document.getElementById("erreurDescription");
    var date_error = document.getElementById("erreurDate");

    if (montant_error.textContent !== "Correct ✔" || 
        description_error.textContent !== "Correct ✔" || 
        date_error.textContent !== "Correct ✔") {
        event.preventDefault(); // Prevent form submission if there are errors
    }
});

// Function to clear errors
function clearErrors() {
    document.getElementById("erreurMontant").textContent = "";
    document.getElementById("erreurDescreption").textContent = "";
    document.getElementById("erreurDate").textContent = "";
    
}
