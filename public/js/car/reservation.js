const bookingOverlay = document.getElementById("booking-overlay");
const reserveBtn = document.getElementById("reserve-btn");
const closePopupBtn = document.getElementById("close-popup");

reserveBtn.addEventListener("click", () => {
    bookingOverlay.style.display = "flex";
});

closePopupBtn.addEventListener("click", () => {
    bookingOverlay.style.display = "none";
});

document
    .querySelectorAll(".popup-reservation .time-button")
    .forEach((button) => {
        button.addEventListener("click", () => {
            document
                .querySelectorAll(".popup-reservation .time-button")
                .forEach((btn) => btn.classList.remove("active"));
            button.classList.add("active");
        });
    });
