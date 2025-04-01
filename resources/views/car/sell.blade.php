@extends('layouts.app')
@section('title', 'Sell the Car')
@section('content')


<header class="mt-50">
    <h1 class="flex-center">Sell the Car</h1>
</header>

<section class="height50 mr-20 ml-20 flex-center-center">
<form action="{{ route('car.sell', $car->id) }}" method="POST" class="form">
    @csrf

    <div class="form-control">
        <label for="client name">
            Client Name:
        </label>
        <input type="text" name="name" placeholder="Client name" required>     
    </div>
    <div class="form-control">
        <label for="client_surname">
            Client Surname:
        </label>
        <input type="text" name="surname" placeholder="Client surname" required>  
    </div>
    <div class="form-control">
        <label for="client_email">
            Client Email:
        </label>
        <input type="email" name="email" placeholder="Client email" required>
    </div>
    <div class="form-control">
        <label for="client_email">
            Client Phone:
        </label>
        <input type="text" name="phone" placeholder="Client phone" required>
    </div>

    <label for="sold_price">Selling Price:</label>
    <input type="number" name="sold_price" value="{{ $car->price }}" step="0.01" required>

    <button type="submit" class="btn btn-icon">Confirm Sale</button>
</form>
<section>

@endsection