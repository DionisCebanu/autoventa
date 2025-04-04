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


document.getElementById('booking-date').addEventListener('change', function () {
    const date = this.value;
    const timeOptionsContainer = document.querySelector('.time-options');

    timeOptionsContainer.innerHTML = '<p>Loading...</p>';

    fetch(`/api/available-slots?date=${date}`)
        .then(res => res.json())
        .then(slots => {
            timeOptionsContainer.innerHTML = ''; // Clear loading

            if (slots.length === 0) {
                timeOptionsContainer.innerHTML = '<p>No available slots for this date.</p>';
                return;
            }

            slots.forEach(slot => {
                const time = slot.start;
            
                const btn = document.createElement('span');
                btn.classList.add('time-button');
                btn.textContent = time;
                btn.dataset.time = time;
            
                btn.addEventListener('click', () => {
                    document.querySelectorAll('.time-button').forEach(b => b.classList.remove('selected'));
                    btn.classList.add('selected');
                    document.getElementById('selected-start-time').value = time;
                });
            
                timeOptionsContainer.appendChild(btn);
            });
            
            
        })
        .catch(err => {
            console.error(err);
            timeOptionsContainer.innerHTML = '<p>Error loading time slots.</p>';
        });
});

