@extends('layouts.app')
@section('title', 'Manage Your Schedule')
@section('content')



<div class="disponibility-section">
    <div class="disponibility-form">
        <div class="body-container">
            <h2>Set Disponibility</h2>
            <div class="date">
                <label for="date-picker">Select a date:</label>
                <input type="date" id="date-picker">
            </div>
            <div class="time-slot">
                <label>Start Time:</label>
                <input type="time" id="start-time">
                <label>End Time:</label>
                <input type="time" id="end-time">
                <button id="add-slot">+ Add Time Slot</button>
            </div>
            <div class="list">
                <h3>Disponibilities:</h3>
                <ul id="disponibility-list"></ul>
            </div>
            <button id="save-btn">💾 Save Disponibility</button>
        </div>
    </div>
</div>




  <script>
    const datePicker = document.getElementById('date-picker');
    const startTime = document.getElementById('start-time');
    const endTime = document.getElementById('end-time');
    const addSlotBtn = document.getElementById('add-slot');
    const disponibilityList = document.getElementById('disponibility-list');
    const saveBtn = document.getElementById('save-btn');

    const disponibilities = {}; // Format: { '2025-04-01': [ { start, end }, ... ] }

    addSlotBtn.addEventListener('click', () => {
        const date = datePicker.value;
        const start = startTime.value;
        const end = endTime.value;

        if (!date || !start || !end) {
            alert('Please select a date and valid time range.');
            return;
        }

        if (!disponibilities[date]) disponibilities[date] = [];

        // Add this to prevent duplicates
        if (disponibilities[date].some(slot => slot.start === start && slot.end === end)) {
            alert('This time slot already exists.');
            return;
        }

        disponibilities[date].push({ start, end });

        console.log('✅ Slot added:', { date, start, end }); // Add this
        console.log('✅ Current disponibilities:', disponibilities); // Add this

        renderDisponibilities();
        startTime.value = '';
        endTime.value = '';
    });

    function renderDisponibilities() {
    disponibilityList.innerHTML = '';

    for (const [date, slots] of Object.entries(disponibilities)) {
        slots.forEach(slot => {
        const li = document.createElement('li');
        li.textContent = `${formatDate(date)}: ${slot.start} – ${slot.end}`;
        disponibilityList.appendChild(li);
        });
    }
    }

    function formatDate(isoDate) {
        const date = new Date(isoDate + 'T00:00');
        const options = { weekday: 'long' };
        const dayName = date.toLocaleDateString(undefined, options);
        return `(${capitalize(dayName)}) ${isoDate}`;
    }

    function capitalize(word) {
        return word.charAt(0).toUpperCase() + word.slice(1);
    }


    saveBtn.addEventListener('click', (e) => {
        e.preventDefault(); // 🛑 This prevents the page from reloading/resetting

        const payload = [];

        for (const [date, slots] of Object.entries(disponibilities)) {
            slots.forEach(slot => {
                payload.push({
                    date: date,
                    start_time: slot.start,
                    end_time: slot.end
                });
            });
        }

        fetch('/schedule/save', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ schedule: payload })
        })
        .then(async res => {
            const text = await res.text();
            try {
                const data = JSON.parse(text);
                let message = '✅ Schedule saved successfully!\n\n';
                payload.foreach(entry => {
                    message += `📅 ${entry.date}: ${entry.start_time} – ${entry.end_time}\n`;
                });
                alert(message);
            } catch (err) {
            }
        })
        .catch(err => {
            console.error(err);
        });
    });


  </script>

@endsection