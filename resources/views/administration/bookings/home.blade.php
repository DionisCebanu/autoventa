@extends('layouts.app')
@section('title', 'Perform your Actions')
@section('content')

<header class="page-title">Select your Actions</header>

<section class="flex-center">
    <div class="structure grid2">
        <a href="/schedule/create">
            <div class="card-selection">
                <h2 class="title">Manage your Schedule</h2>
            </div>
        </a>
        <a href="/bookings/list">
            <div class="card-selection">
                <h2 class="title">View Upcoming Bookings</h2>
            </div>
        </a>
    </div>
</section>
@endsection