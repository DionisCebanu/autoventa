@extends('layouts.app')
@section('title', 'Upcoming Bookings')
@section('content')

<div class="admin-bookings">
    <h2>📘 All Bookings</h2>

    @forelse ($bookings as $booking)
        <div class="booking-card">
            <div class="booking-info">
                <p><strong>Client:</strong> {{ $booking->name }}</p>
                <p><strong>Email:</strong> {{ $booking->email }}</p>
                <p><strong>Phone:</strong> {{ $booking->phone }}</p>
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


@endsection
