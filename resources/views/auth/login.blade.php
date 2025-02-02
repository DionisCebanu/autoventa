@extends('layouts.app')
@section('title', 'Login')
@section('content')


<!-- Display success or error messages -->
@if(!$errors->isEmpty())
    <div class="alert error" role="alert">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>     
        <button type="button" class="btn-close">X</button>
    </div>                
@endif 

<header class="mt-50">
    <h1 class="flex-center">Login</h1>
</header>
<!-- Login form -->
<section class="height50 mr-20 ml-20 flex-center-center">
    <form action="{{ route('auth.login.submit') }}" method="POST" class="form">
        @csrf
        <div class="form-control">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        </div>
    
        <div class="form-control">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
    
        <button type="submit" class="btn">Login</button>
    </form>
</section>

@endsection