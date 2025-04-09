@extends('layouts.app')
@section('title', 'Login')
@section('content')

<style>
.login-container {
    height: 100vh;
    background: url('{{ asset('img/administration/login.jpg') }}') no-repeat center center/cover;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
}

.login-form {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-radius: 15px;
    padding: 40px 30px;
    max-width: 360px;
    width: 100%;
    color: #fff;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
    text-align: center;
}

.login-form h2 {
    margin-bottom: 30px;
    font-size: 28px;
}

.input-icon {
    position: relative;
    margin-bottom: 20px;
}

.input-icon i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--blue);
    font-size: 14px;
}

.input-icon input {
    width: 100%;
    padding: 12px 12px 12px 40px;
    border: none;
    border-radius: 25px;
    font-size: 14px;
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
}

.input-icon input::placeholder {
    color: #eee;
}

.input-icon input:focus {
    outline: none;
    background: rgba(255, 255, 255, 0.3);
}

</style>
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

<!-- Login form -->
<section class="login-container">
    <form action="{{ route('auth.login.submit') }}" method="POST" class="login-form">
        @csrf
        <div class="input-icon">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email" required>
        </div>

        <div class="input-icon">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" id="password" placeholder="Password" required>
        </div>
    
        <button type="submit" class="btn flex-center w-100 gap10 p-10">
            <i class="fas fa-sign-in-alt"></i> Login
        </button>
    </form>
</section>

@endsection