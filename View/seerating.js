document.addEventListener('DOMContentLoaded', function () {
    const medications = document.querySelectorAll('.rating');

    medications.forEach(medication => {
        const stars = medication.querySelectorAll('.star');

        stars.forEach(star => {
            star.addEventListener('click', function () {
                const value = parseInt(star.dataset.value);
                const medicationId = medication.dataset.medicationId;

                // Simulate a backend call to store the rating
                // You should send this data to your server via AJAX
                // For example:
                // const xhr = new XMLHttpRequest();
                // xhr.open('POST', 'store_rating.php');
                // xhr.setRequestHeader('Content-Type', 'application/json');
                // xhr.send(JSON.stringify({ medicationId: medicationId, rating: value }));

                // Set the rating in the HTML (for simulation purposes)
                medication.querySelector('.stars').setAttribute('data-rating', value);

                // Update stars based on the selected value
                stars.forEach(s => {
                    const sValue = parseInt(s.dataset.value);
                    s.textContent = (sValue <= value) ? '★' : '☆';
                });
            });
        });
    });
});
