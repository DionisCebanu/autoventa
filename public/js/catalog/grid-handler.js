const cardCars = document.querySelectorAll('.card-car');
const count = cardCars.length;
if (count === 1) {
    cardCars.forEach(card => {
        card.style.width = "33%"
    });
} else {
    cardCars.forEach(card => {
        card.style.width = "100%"
    });
}
