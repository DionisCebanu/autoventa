@extends('layouts.app')
@section('title', 'Upcoming Bookings')
@section('content')
<div class="booking-filter">
    <label for="booking-date-picker">Filter by date:</label>
    <input type="date" id="booking-date-picker">
</div>

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


<script>
    document.getElementById('booking-date-picker').addEventListener('change', function () {
    const selectedDate = this.value;
    const container = document.getElementById('booking-results');

    container.innerHTML = '<p>Loading...</p>';

    fetch(`/api/bookings/by-date?date=${selectedDate}`)
        .then(res => res.json())
        .then(bookings => {
            container.innerHTML = '';

            if (bookings.length === 0) {
                container.innerHTML = '<p class="no-bookings">No bookings for this date.</p>';
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
                        ${booking.car ? `<a href="/car/${booking.car.id}" class="btn"> View Car <i>🔎</i></a>` : '<span class="text-muted">❌ N/A</span>'}
                    </div>
                `;
                container.appendChild(div);
            });
        })
        .catch(err => {
            container.innerHTML = '<p>Error loading bookings.</p>';
            console.error(err);
        });
});

</script>

@endsection
