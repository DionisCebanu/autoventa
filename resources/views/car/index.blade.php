@extends('layouts.app')
@section('title', 'Home')
@section('content')

    <header class="header-img">
        <img src="{{ asset('img/gallery/collection.jpg')}}" alt="our collection">

        <div class="header-overlay typewriter">
            <h1>Discover Our collection</h1>
        </div>
    </header>

    <section class="filter-section">
        <div class="filter-container">
            <form class="filter-form">
                <select>
                    <option value="" disabled selected>Makes</option>
                    <!-- Add more options -->
                </select>
                <select>
                    <option value="" disabled selected>Models</option>
                    <!-- Add more options -->
                </select>
                <select>
                    <option value="" disabled selected>Price</option>
                    <!-- Add more options -->
                </select>
                <select>
                    <option value="" disabled selected>Year</option>
                    <!-- Add more options -->
                </select>
                <button class="btn" type="submit">Search Now</button>
            </form>
        </div>
    </section>

    <section class="catalog flex-center">
        <div class="structure">
            <header class="catalog-header flex-right">
                <details class="sortbox">
                    <summary class="sortbox-selected">
                      <span>Sort By:</span>
                    </summary>
                    <ul class="sortbox-list">
                      <li>
                        <label for="option1">Default</label>
                        <input type="radio" name="sortbox" id="option1">
                      </li>
                      <li>
                        <label for="option2">Price: Low-High</label>
                        <input type="radio" name="sortbox" id="option2">
                      </li>
                      <li>
                        <label for="option3">Price: High to Low</label>
                        <input type="radio" name="sortbox" id="option3">
                      </li>
                      <li>
                        <label for="option4">Item 4</label>
                        <input type="radio" name="sortbox" id="option4">
                      </li>
                    </ul>
                </details>


            </header>

            <section class="grid-container">
                @foreach ($cars as $car)
                    <div class="card-car">
                        <div class="card-car-img">
                        <img src="{{ $car->images->first() ? $car->images->first()->image_path : asset('img/gallery/collection/default-image/default.jpg') }}" 
                            alt="{{ $car->make }} {{ $car->model }}">
                            <div class="type-car">
                                <p>{{ $car->type }}</p>
                            </div>
                        </div>
                        <div class="card-car-description">
                            <div class="car-description-price">
                                <span>{{ number_format($car->price, 2) }}£</span>
                                <h2>{{ $car->make }} {{ $car->model }} {{ $car->year }}</h2>
                            </div>
                        </div>
                        <div class="card-car-footer">
                            <div class="card-car-footer__item flex-al gap10">
                                <i class="fa-solid fa-gas-pump"></i>
                                <div class="card--footer-item__desc">
                                    <span>Fuel Type</span>
                                    <p>{{ $car->fuel_type }}</p>
                                </div>
                            </div>

                            <div class="vertical-line"></div>

                            <div class="card-car-footer__item flex-al gap10">
                                <i class="fa-solid fa-road"></i>
                                <div class="card--footer-item__desc">
                                    <span>Mileage</span>
                                    <p>{{ number_format($car->mileage) }} km</p>
                                </div>
                            </div>

                            <div class="vertical-line"></div>

                            <div class="card-car-footer__item flex-al gap10">
                                <i class="fa-solid fa-gears"></i>
                                <div class="card--footer-item__desc">
                                    <span>Transmission</span>
                                    <p>{{ $car->transmission }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-car-button">
                            <a href="{{ url('/car', $car->id) }}">VIEW DETAILS <i>→</i></a>
                        </div>
                    </div>
                @endforeach
            </section>

        </div>
    </section>


@endsection
