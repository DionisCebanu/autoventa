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


document.querySelectorAll(".next-step").forEach((btn) => {
    btn.addEventListener("click", () => {
        const currentSection = btn.closest(".form-section");
        const nextId = btn.dataset.next;
        const nextSection = document.getElementById(nextId);

        if (nextSection) {
            currentSection.style.display = "none";
            nextSection.style.display = "block";
        }
    });
});

document.querySelectorAll(".prev-step").forEach((btn) => {
    btn.addEventListener("click", () => {
        const currentSection = btn.closest(".form-section");
        const prevId = btn.dataset.prev;
        const prevSection = document.getElementById(prevId);

        if (prevSection) {
            currentSection.style.display = "none";
            prevSection.style.display = "block";
        }
    });
});



/**
 * Level Steps
 */

function updateStepBar(currentId) {
    document.querySelectorAll(".step").forEach(step => {
        step.classList.remove("active");
        if (step.dataset.step === currentId) {
            step.classList.add("active");
        }
    });
}

document.querySelectorAll(".next-step").forEach((btn) => {
    btn.addEventListener("click", () => {
        const currentSection = btn.closest(".form-section");
        const nextId = btn.dataset.next;
        const nextSection = document.getElementById(nextId);

        if (nextSection) {
            currentSection.classList.add("hidden-step");
            nextSection.classList.remove("hidden-step");
            updateStepBar(nextId);
        }
    });
});

document.querySelectorAll(".prev-step").forEach((btn) => {
    btn.addEventListener("click", () => {
        const currentSection = btn.closest(".form-section");
        const prevId = btn.dataset.prev;
        const prevSection = document.getElementById(prevId);

        if (prevSection) {
            currentSection.classList.add("hidden-step");
            prevSection.classList.remove("hidden-step");
            updateStepBar(prevId);
        }
    });
});

function updateStepBar(currentId) {
    const steps = Array.from(document.querySelectorAll(".progress-step"));
    const lines = document.querySelectorAll(".progress-line");

    let activeIndex = steps.findIndex(step => step.dataset.step === currentId);

    steps.forEach((step, index) => {
        step.classList.toggle("active", index <= activeIndex);
    });

    lines.forEach((line, index) => {
        line.classList.toggle("active", index < activeIndex);
    });
}
