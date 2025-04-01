@extends('layouts.app')
@section('title', 'Manage Your Schedule')
@section('content')

<style>
    .disponibility-form {
    background: white;
    max-width: 600px;
    margin: auto;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    h2, h3 {
    margin-top: 0;
    }

    label {
    margin-right: 10px;
    }

    input[type="time"], select {
    padding: 5px 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
    margin-bottom: 10px;
    }

    button {
    background-color: #007bff;
    border: none;
    color: white;
    padding: 6px 12px;
    border-radius: 6px;
    cursor: pointer;
    margin-top: 10px;
    }

    button:hover {
    background-color: #0056b3;
    }

    .time-slot {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    }

    ul {
    list-style: none;
    padding-left: 0;
    }

    ul li {
    background: #e9ecef;
    padding: 8px;
    margin-top: 6px;
    border-radius: 6px;
    }
</style>

<div class="disponibility-form">
    <h2>Set Disponibility</h2>

    <label for="date-picker">Select a date:</label>
    <input type="date" id="date-picker">

    <div class="time-slot">
        <label>Start Time:</label>
        <input type="time" id="start-time">
        <label>End Time:</label>
        <input type="time" id="end-time">
        <button id="add-slot">+ Add Time Slot</button>
    </div>

    <h3>Disponibilities:</h3>
    <ul id="disponibility-list"></ul>

    <button id="save-btn">💾 Save Disponibility</button>
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
    disponibilities[date].push({ start, end });

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


    saveBtn.addEventListener('click', () => {
    console.log('Disponibility Saved:', JSON.stringify(disponibilities, null, 2));
    alert('Disponibility saved! Check the console for the JSON result.');
    });

  </script>

@endsection