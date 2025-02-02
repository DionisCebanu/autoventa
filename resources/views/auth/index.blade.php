@extends('layouts.app')
@section('title', 'User Create')
@section('content')


    
    
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <header class="mt-40 mb-10">
        <h1 class="flex-center">Register</h1>
    </header>
    <section class="flex-center-center mr-10 ml-10">
        
        <form action="{{ route('auth.create') }}" method="POST" class="form">
            @csrf
            <div class="form-control">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>
            </div>
        
            <div class="form-control">
                <label for="surname">Surname:</label>
                <input type="text" name="surname" id="surname" required>
            </div>
        
            <div class="form-control">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
        
            <div class="form-control">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
        
            <div class="form-control">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>
        
            <button type="submit" class="btn">Register</button>
        </form>
    </section>


@endsection