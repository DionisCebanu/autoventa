@extends('layouts.app')
@section('title', 'Upcoming Bookings')
@section('content')

<div class="admin-bookings">
    <h2>All Bookings</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Client Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Car Make</th>
                <th>Car Model</th>
                <th>Car Details</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bookings as $booking)
                <tr>
                    <td>{{ $booking->name }}</td>
                    <td>{{ $booking->email }}</td>
                    <td>{{ $booking->phone }}</td>
                    <td>
                        {{ $booking->car->make ?? 'N/A' }}
                    </td>
                    <td>
                        {{ $booking->car->model ?? 'N/A' }}
                    </td>
                    <td>
                        @if ($booking->car)
                            <a href="{{ url('/car/' . $booking->car->id) }}" class="btn">View Car</a>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No bookings yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
