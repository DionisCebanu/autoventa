@extends('layouts.app')
@section('title', 'Upcoming Bookings')
@section('content')

<section class="bookings-page">
    <div id="custom-datepicker" class="calendar-grid"></div>
    <div class="calendar-instructions">Click a date to see bookings.</div>
    <div class="calendar-instructions">Booked Dates are marked with ✔️</div>
    <div class="admin-bookings" id="booking-results">
        <h2>📘 All Bookings</h2>
    
        @forelse ($bookings as $booking)
            <div class="booking-card">
                <div class="booking-info">
                    <p><strong>Client:</strong> {{ $booking->name }}</p>
                    <p><strong>Email:</strong> {{ $booking->email }}</p>
                    <p><strong>Phone:</strong> {{ $booking->phone }}</p>
                    <p><strong>Date:</strong> {{ $booking->date }}</p>
                    <p><strong>Make:</strong> {{ $booking->car->make ?? 'N/A' }}</p>
                    <p><strong>Model:</strong> {{ $booking->car->model ?? 'N/A' }}</p>
                </div>
                <div class="booking-actions">
                    @if ($booking->car)
                        <a href="{{ url('/car/' . $booking->car->id) }}" class="btn"> View Car <i>🔎</i></a>
                    @else
                        <span class="text-muted">❌ N/A</span>
                    @endif
                </div>
            </div>
        @empty
            <p class="no-bookings">No bookings yet 😢</p>
        @endforelse
    </div>
</section>

<script>
    const calendar = document.getElementById('custom-datepicker');
    const bookingContainer = document.getElementById('booking-results');
    const currentMonth = 3; // April (0-indexed)
    const currentYear = 2025;

    // Fetch booked dates from backend
    fetch('/api/bookings/dates')
        .then(res => res.json())
        .then(bookedDates => {
            renderCalendar(currentYear, currentMonth, bookedDates);
        });

    function renderCalendar(year, month, bookedDates = []) {
        calendar.innerHTML = ''; // clear existing calendar

        const date = new Date(year, month, 1);
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        for (let day = 1; day <= daysInMonth; day++) {
            const isoDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const div = document.createElement('div');
            div.classList.add('calendar-day');
            if (bookedDates.includes(isoDate)) {
                div.classList.add('booked');
            }

            div.textContent = day;
            div.dataset.date = isoDate;

            div.addEventListener('click', () => {
                fetchBookingsByDate(isoDate);
            });

            calendar.appendChild(div);
        }
    }

    function fetchBookingsByDate(date) {
        bookingContainer.innerHTML = 'Loading...';

        fetch(`/api/bookings/by-date?date=${date}`)
            .then(res => res.json())
            .then(bookings => {
                bookingContainer.innerHTML = '';

                if (!bookings.length) {
                    bookingContainer.innerHTML = `<p>No bookings for ${date}</p>`;
                    return;
                }

                bookings.forEach(booking => {
                    const div = document.createElement('div');
                    div.className = 'booking-card';
                    div.innerHTML = `
                        <div class="booking-info">
                            <p><strong>Client:</strong> ${booking.name}</p>
                            <p><strong>Email:</strong> ${booking.email}</p>
                            <p><strong>Phone:</strong> ${booking.phone}</p>
                            <p><strong>Date:</strong> ${booking.date}</p>
                            <p><strong>Make:</strong> ${booking.car?.make ?? 'N/A'}</p>
                            <p><strong>Model:</strong> ${booking.car?.model ?? 'N/A'}</p>
                        </div>
                        <div class="booking-actions">
                            ${booking.car ? `<a href="/car/${booking.car.id}" class="btn">View Car</a>` : 'N/A'}
                        </div>
                    `;
                    bookingContainer.appendChild(div);
                });
            });
}

</script>

@endsection
