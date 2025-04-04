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
                const start = slot.start;
                const end = slot.end;
                const intervalButtons = generateIntervalButtons(start, end);
            
                intervalButtons.forEach(time => {
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
            });
            
        })
        .catch(err => {
            console.error(err);
            timeOptionsContainer.innerHTML = '<p>Error loading time slots.</p>';
        });
});

/**
 * 
 * Funtion to generate intervals each 30 minutes
 */
function generateIntervalButtons(start, end) {
    const intervals = [];

    let [startHour, startMinute] = start.split(':').map(Number);
    let [endHour, endMinute] = end.split(':').map(Number);

    const pad = n => n.toString().padStart(2, '0');

    while (startHour < endHour || (startHour === endHour && startMinute <= endMinute)) {
        intervals.push(`${pad(startHour)}:${pad(startMinute)}`);

        startMinute += 30;
        if (startMinute >= 60) {
            startMinute = 0;
            startHour += 1;
        }
    }

    return intervals;
}
