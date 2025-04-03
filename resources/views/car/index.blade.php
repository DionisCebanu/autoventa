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
            <form class="filter-form" id="filter-form">
            <div class="custom-select" data-name="make">
                <div class="select-selected">Makes</div>
                    <ul class="select-options">
                        @foreach($makes as $make)
                        <li data-value="{{ $make }}">{{ $make }}</li>
                        @endforeach
                    </ul>
                    <input type="hidden" name="make" id="make">
                </div>

                <!-- MODEL -->
                <div class="custom-select" data-name="model">
                    <div class="select-selected">Models</div>
                    <ul class="select-options">
                        @foreach($models as $model)
                        <li data-value="{{ $model }}">{{ $model }}</li>
                        @endforeach
                    </ul>
                    <input type="hidden" name="model" id="model">
                </div>

                <!-- YEAR -->
                <div class="custom-select" data-name="year">
                    <div class="select-selected">Years</div>
                        <ul class="select-options">
                            @foreach($years as $year)
                            <li data-value="{{ $year }}">{{ $year }}</li>
                            @endforeach
                        </ul>
                        <input type="hidden" name="year" id="year">
                    </div>
                <button class="btn" type="submit" id="filter-btn">Search Now</button>
            </form>
        </div>
    </section>

    <section class="catalog flex-center">
        <div class="structure">
            <header class="catalog-header flex-right">
            <details class="sortbox" id="sortbox">
                <summary class="sortbox-selected"><span>Sort By:</span></summary>
                <ul class="sortbox-list">
                    <li>
                    <label for="default">Default</label>
                    <input type="radio" name="sort" id="default" checked>
                    </li>
                    <li>
                    <label for="price_ascending">Price: Low-High</label>
                    <input type="radio" name="sort" id="price_ascending">
                    </li>
                    <li>
                    <label for="price_descending">Price: High to Low</label>
                    <input type="radio" name="sort" id="price_descending">
                    </li>
                </ul>
            </details>



            </header>

            <section class="grid-container" id="car-results">
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

    <script src="{{ asset('js/catalog/grid-handler.js')}}" defer></script>
    <script src="{{ asset('js/catalog/filter-api.js')}}" defer></script>


@endsection
