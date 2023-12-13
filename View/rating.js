document.querySelectorAll('.rating').forEach(rating => {
    const medicationId = rating.dataset.medicationId;
    let storedRating = localStorage.getItem(`medication_${medicationId}_rating`);
    if (storedRating) {
        setStars(rating, storedRating);
    }

    rating.addEventListener('click', event => {
        const clickedStar = event.target;
        const ratingValue = clickedStar.dataset.value;

        setStars(rating, ratingValue);

        // Save the rating in localStorage
        localStorage.setItem(`medication_${medicationId}_rating`, ratingValue);
    });
});

function setStars(rating, value) {
    rating.querySelectorAll('.star').forEach(star => {
        star.textContent = (star.dataset.value <= value) ? '★' : '☆';
    });
}
function setRating(medicationId, rating) {
    localStorage.setItem(`medication_${medicationId}_rating`, rating);
    // Additional code to update UI or perform other actions after setting the rating
}
