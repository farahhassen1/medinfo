 function validateForm() {
            var title = document.getElementById('titrearticle').value;
            var content = document.getElementById('contenuarticle').value;
            var date = document.getElementById('datepubliarticle').value;

            var titleRegex = /^[a-zA-Z0-9\s]+$/; // Alphanumeric characters and spaces
            var contentRegex = /^[a-zA-Z0-9\s]+$/; // Alphanumeric characters and spaces

            var isValid = true;

            if (!title.match(titleRegex)) {
                document.getElementById('titrearticle-error').innerHTML = 'Title can only contain letters, numbers, and spaces';
                isValid = false;
            } else {
                document.getElementById('titrearticle-error').innerHTML = '';
            }

            if (!content.match(contentRegex)) {
                document.getElementById('contenuarticle-error').innerHTML = 'Content can only contain letters, numbers, and spaces';
                isValid = false;
            } else {
                document.getElementById('contenuarticle-error').innerHTML = '';
            }

            if (date.trim() === "") {
                document.getElementById('datepubliarticle-error').innerHTML = 'Date is required';
                isValid = false;
            } else {
                document.getElementById('datepubliarticle-error').innerHTML = '';
            }

            return isValid;
        }

