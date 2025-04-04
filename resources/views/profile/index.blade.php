@extends('layouts.app')
@section('title', 'Profile')
@section('content')

<main class="flex-center">
    <article class="profile">
        <header class="profile-header">
            <h3>Profile</h3>
            <img src="{{ asset('img/administration/profile/notification.png') }}" alt="notification">
        </header>
        <article>
            <div class="profile-img">
                <img src="{{ asset('img/nav/profile.png') }}" alt="profile">
                <span class="edit-icon">
                    <i class="fa-solid fa-pen"></i>
                </span>
            </div>
            <h3>Mihail Sidorenco</h3>
        </article>
        <div class="profile-links">
            <a href="/bookings/home">
                <div class="link">
                    <div class="link-item">
                        <i class="fa-solid fa-calendar"></i>
                        <p>Bookings</p>
                    </div>
                    <img src="https://img.icons8.com/?size=100&id=98971&format=png&color=000000" alt="arrow right">
                </div>
            </a>
            <div class="link">
                <div class="link-item">
                    <i class="fa-solid fa-wallet"></i>
                    <p>Payments</p>
                </div>
                <img src="https://img.icons8.com/?size=100&id=98971&format=png&color=000000" alt="arrow right">
            </div>
            <div class="link">
                <div class="link-item">
                    <i class="fa-solid fa-user"></i>
                    <p>Profile</p>
                </div>
                <img src="https://img.icons8.com/?size=100&id=98971&format=png&color=000000" alt="arrow right">
            </div>
            <div class="link">
                <div class="link-item">
                    <i class="fa-solid fa-bell"></i>
                    <p>Notification</p>
                </div>
                <img src="https://img.icons8.com/?size=100&id=98971&format=png&color=000000" alt="arrow right">
            </div>
        
            <a href="/car/create">
                <div class="link">
                    <div class="link-item">
                        <i class="fa-solid fa-car"></i>
                        <p>Create a Car</p>
                    </div>
                    <img src="https://img.icons8.com/?size=100&id=98971&format=png&color=000000" alt="arrow right">
                </div>
            </a>
            
            <a href="/catalog">
                <div class="link">
                    <div class="link-item">
                        <i class="fa-solid fa-box"></i>
                        <p>Manage Catalog</p>
                    </div>
                    <img src="https://img.icons8.com/?size=100&id=98971&format=png&color=000000" alt="arrow right">
                </div>
            </a>
            <div class="link">
                <div class="link-item">
                    <i class="fa-solid fa-circle-info"></i>
                    <p>Help Center (Dioniska)</p>
                </div>
                <img src="https://img.icons8.com/?size=100&id=98971&format=png&color=000000" alt="arrow right">
            </div>
            <a href="/statistics/sold">
                <div class="link">
                    <div class="link-item">
                        <i class="fa-solid fa-chart-bar"></i>
                        <p>Statistics</p>
                    </div>
                    <img src="https://img.icons8.com/?size=100&id=98971&format=png&color=000000" alt="arrow right">
                </div>
            </a>
            <!-- Logout button -->
            <div class="link logout">
                <div class="link-item">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <form action="{{ route('auth.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="">Logout</button>
                    </form>
                </div>
            </div>
            
        </div>
    </article>
</main>


@endsection