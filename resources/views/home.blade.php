@extends('layouts.app')
@section('title', 'Home')
@section('content')
<main>
<!--https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_slideshow-->
<section class="carousel-main-section">
    <div class="carousel-container">
        @foreach ($promotedCars as $index => $car)
            <div class="mySlides fade">
                <img src="{{ $car->images->first() ? asset($car->images->first()->image_path) : asset('img/gallery/collection/default-image/default.jpg') }}" 
                    alt="{{ $car->make }} {{ $car->model }}" style="width:100%">
                <div class="info-product-promoted">
                    <div class="promoted-product__title typewriter">
                        <h1>{{ $car->make }} {{ $car->model }}</h1>
                    </div>
                    <div class="promoted-product__description typewriter">
                        <p>Just arrived! {{ $car->make }} {{ $car->model }} now available</p>
                    </div>
                    <div class="header-box__buttons">
                        <a href="/catalog" class="btn">Check the offers</a>
                        <a href="/car/{{ $car->id }}" class="btn btn-no-bg">Reserve Now</a>
                    </div>
                </div>
            </div>
        @endforeach

        <a class="prev">❮</a>
        <a class="next">❯</a>
    </div>

    <br>
    <div style="text-align:center">
        @foreach ($promotedCars as $index => $car)
            <span class="dot" onclick="currentSlide({{ $index + 1 }})"></span>
        @endforeach
    </div>
</section>
<section class="latest-arrivals flex-center">
    <div class="structure">
        <div class="latest-arrivals-title block">
            <h2>Latest Arrivals</h2>
        </div>
        <div class="latest-arrivals-cars-container">
            @foreach ($latestCars as $car)
                <div class="latest-arrival-car-card block">
                    <h3>{{ $car->make }} {{ $car->model }}</h3>
                    <img src="{{ $car->images->first() ? asset($car->images->first()->image_path) : asset('img/gallery/collection/default-image/default.jpg') }}" 
                         alt="{{ $car->make }} {{ $car->model }}">
                    <div class="car-details">
                        <p>YEAR: <span>{{ $car->year }}</span></p>
                        <p>COLOUR: <span>{{ $car->color ?? 'N/A' }}</span></p> {{-- Assuming "color" is in a related table or added later --}}
                        <p>MILEAGE: <span>{{ number_format($car->mileage) }} km</span></p>
                        <p>PRICE: <span>£{{ number_format($car->price, 2) }}</span></p>
                    </div>
                    <a href="{{ url('/car', $car->id) }}" class="btn-no-bg">View Vehicle</a>
                </div>
            @endforeach
        </div>
    </div>
</section>


<section class="search-car-section flex-center">
    <div class="structure flex-col gap30">
        <div class="search-car-header flex-column-center gap20 block">
            <small>Our collection</small>
            <h3>Find Your Dream Car Today</h3>
        </div>
       <!--  <div class="search-car-form-box ">
            <div class="search-car-item block">
                <select name="makes" id="">
                    <option value="make1">Any Makes</option>
                    <option value="make1">make1</option>
                    <option value="make2">make2</option>
                    <option value="make3">make3</option>
                    <option value="make4">make4</option>
                    <option value="make5">make5</option>
                </select>

                <select name="models" id="">
                    <option value="model1">Any Models</option>
                    <option value="model1">model1</option>
                    <option value="model2">model2</option>
                    <option value="model3">model3</option>
                    <option value="model4">model4</option>
                    <option value="model5">model5</option>
                </select>

                <input type="text" value="Prices: All Prices" readonly>

                <button class="btn-no-bg btn-search-form">
                    <i class="fa fa-search"></i> Search Cars
                </button>
            </div>
        </div> -->
        
        <form action="{{ route('car.index') }}" method="GET" class="search-car-form-box">
            <div class="search-car-item">
                <select name="make">
                    <option value="">Make</option>
                    @foreach ($makes as $make)
                        <option value="{{ $make }}">{{ $make }}</option>
                    @endforeach
                </select>
                <select name="model">
                    <option value="">Model</option>
                    @foreach ($models as $model)
                        <option value="{{ $model }}">{{ $model }}</option>
                    @endforeach
                </select>
                <select name="year">
                    <option value="">Year</option>
                    @foreach ($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-no-bg btn-search-form">Search Now <i class="fa fa-search"></i></button>
            </div>         
        </form>

    </div>
</section>

<section class="browse-by-type flex-center">
    <div class="structure">
        <div class="browse-title block">
            <h2>Browse By Type</h2>
            <!-- <a href="#" class="view-all">View All &rarr;</a> -->
        </div>
        <div class="types-container">
            <div class="type-item block">
                <img src="{{ asset('img/gallery/collection/types/suv.jpg') }}" alt="SUV">
                <div class="type-label">
                    <i class="fa fa-car"></i> SUV
                </div>
            </div>
            <div class="type-item block">
                <img src="{{ asset('img/gallery/collection/types/sedan.jpg') }}" alt="Sedan">
                <div class="type-label">
                    <i class="fa fa-car"></i> Sedan
                </div>
            </div>
            <div class="type-item block">
                <img src="{{ asset('img/gallery/collection/types/hatchback.jpg') }}" alt="Hatchback">
                <div class="type-label">
                    <i class="fa fa-car"></i> Hatchback
                </div>
            </div>
            <div class="type-item block">
                <img src="{{ asset('img/gallery/collection/types/hybrid.jpg') }}" alt="Hybrid">
                <div class="type-label">
                    <i class="fa fa-car"></i> Hybrid
                </div>
            </div>
            <div class="type-item block">
                <img src="{{ asset('img/gallery/collection/types/coupe.jpg') }}" alt="Coupe">
                <div class="type-label">
                    <i class="fa fa-car"></i> Coupe
                </div>
            </div>
        </div>
    </div>
</section>

<div class="header_full_sec overflow-hidden flex-center-center block height30 ">
    <div class="logos">
        <div class="logos-slide ">
            <div class="ticker__item">New Car Sales</div>
            <div class="ticker__item ticker__item_dark">Certified Pre-Owned</div>
            <div class="ticker__item">Financing Options</div>
            <div class="ticker__item ticker__item_dark">Car Leasing</div>
            <div class="ticker__item">Trade-In Services</div>
            <div class="ticker__item ticker__item_dark">Vehicle Insurance</div>
            <div class="ticker__item">Warranty Programs</div>
            <div class="ticker__item ticker__item_dark">Car Maintenance</div>
            <div class="ticker__item">Test Drive Scheduling</div>
            <div class="ticker__item ticker__item_dark">Special Offers</div>
        </div>
        <div class="logos-slide">
            <div class="ticker__item">Fleet Management</div>
            <div class="ticker__item ticker__item_dark">Online Car Valuation</div>
            <div class="ticker__item">After-Sales Support</div>
            <div class="ticker__item ticker__item_dark">Car Detailing</div>
            <div class="ticker__item">Luxury Car Rentals</div>
            <div class="ticker__item ticker__item_dark">Extended Warranties</div>
            <div class="ticker__item">24/7 Roadside Assistance</div>
            <div class="ticker__item ticker__item_dark">Instant Loan Approval</div>
            <div class="ticker__item">Mobile App Services</div>
            <div class="ticker__item ticker__item_dark">Customer Loyalty Program</div>
        </div>
    </div>

</div>

<section class="brands-section flex-center height30">
    <div class="structure">
        <div class="brand-header block">
            <h2>Explore Our Premium Brands</h2>
        </div>
        <div class="brands-container">
            <div class="brand-item block">
                <img src="{{ asset('img/logo/car-logo/audi-logo.png') }}" alt="audi.logo">
                <p>Audi</p>
            </div>
            <div class="brand-item block">
                <img src="{{ asset('img/logo/car-logo/bmw-logo.png') }}" alt="bmw.logo">
                <p>BMW</p>
            </div>
            <div class="brand-item block">
                <img src="{{ asset('img/logo/car-logo/ford-logo.png') }}" alt="ford.logo">
                <p>Ford</p>
            </div>
            <div class="brand-item block">
                <img src="{{ asset('img/logo/car-logo/volkswagen-logo.png') }}" alt="volkswagen.logo">
                <p>Volkswagen</p>
            </div>
            <div class="brand-item block">
                <img src="{{ asset('img/logo/car-logo/mercedes-logo.png') }}" alt="mercedes.logo">
                <p>Mercedes</p>
            </div>
            <!-- Repeat for other brands -->
        </div>
    </div>
</section>





<!---Image Slider END-->

<section class="section__why-us flex-center-center">
    <div class="structure">
        <div class="container__why-us block">
            <div class="why-us__item">
                <div class="why-us__item--title">
                    <h3>2K</h3>
                </div>
                <div class="why-us__item--subtitle">
                    <h4>Clients</h4>
                </div>
            </div>

            <div class="why-us__item">
                <div class="why-us__item--title">
                    <h3>100+</h3>
                </div>
                <div class="why-us__item--subtitle">
                    <h4>Cars sold</h4>
                </div>
            </div>

            <div class="why-us__item">
                <div class="why-us__item--title">
                    <h3>100%</h3>
                </div>
                <div class="why-us__item--subtitle">
                    <h4>Guaranteed Financing</h4>
                </div>
            </div>

            <div class="why-us__item">
                <div class="why-us__item--title">
                    <h3>90%</h3>
                </div>
                <div class="why-us__item--subtitle">
                    <h4>Satisfied customers</h4>
                </div>
            </div>
        </div>
    </div>
</section>








<!--Testimonials-->
<section class="slider-product flex-center">
    <div class="structure">
        <div class="wrapper">
            <i id="left" class="fa-solid fas fa-angle-left"></i>
            <div class="carousel block">
                <div class="card-product">
                    <div class="product_card--img">
                        <img src="{{ asset('img/personages/image-sarah.jpg') }}" alt="news_1" draggable="false">
                    </div>
                    <h2>
                        Ariana
                    </h2>

                    <div class="review__description">
                        <i class="fa-solid fa-quote-left" style="color: #99600f;"></i>
                        An amazing car-buying experience! The team was extremely knowledgeable and guided me through every step of the process. I found my dream car at a great price and couldn't be happier with my purchase!
                         <i class="fa-solid fa-quote-right" style="color: #99600f;"></i>
                    </div>
                </div>

                <div class="card-product">
                    <div class="product_card--img">
                        <img src="{{ asset('img/personages/image-sarah.jpg') }}" alt="news_2" draggable="false">
                    </div>
                    <h2>
                        Mirela
                    </h2>
                    <div class="review__description">
                        <i class="fa-solid fa-quote-left" style="color: #99600f;"></i>
                        I traded in my old car and got a fantastic deal on a new one! The entire process was quick and easy, and I appreciated the transparency from the sales team. Highly recommend this dealership!
                        <i class="fa-solid fa-quote-right" style="color: #99600f;"></i>
                    </div>
                </div>

                <div class="card-product">
                    <div class="product_card--img">
                        <img src="{{ asset('img/personages/image-sarah.jpg') }}" alt="news_3" draggable="false">
                    </div>
                    <h2>Marcela</h2>
                    <div class="review__description">
                        <i class="fa-solid fa-quote-left" style="color: #99600f;"></i>
                        This is hands down the best car dealership I've ever visited. The staff was friendly, professional, and helped me secure financing with a low interest rate. I'll definitely be coming back for future purchases.
                        <i class="fa-solid fa-quote-right" style="color: #99600f;"></i>
                    </div>
                </div>

                <div class="card-product">
                    <div class="product_card--img">
                        <img src="{{ asset('img/personages/image-sarah.jpg') }}" alt="news_4" draggable="false">
                    </div>
                   <h2>Jana</h2>
                    <div class="review__description">
                        <i class="fa-solid fa-quote-left" style="color: #99600f;"></i>
                        I had a wonderful experience purchasing my car here. The sales team didn't pressure me at all and answered all my questions. I drove away in a car that exceeded my expectations, and I’m very satisfied!
                        <i class="fa-solid fa-quote-right" style="color: #99600f;"></i>
                    </div>
                </div>

                <div class="card-product">
                    <div class="product_card--img">
                        <img src="{{ asset('img/personages/image-sarah.jpg') }}" alt="stamp_4" draggable="false">
                    </div>
                    <h2>Daria</h2>
                    <div class="review__description">
                        <i class="fa-solid fa-quote-left" style="color: #99600f;"></i>
                        From the test drive to the final paperwork, the entire process was seamless. They even offered me a complimentary car detailing service after the purchase. Exceptional service and an unbeatable selection of cars!
                        <i class="fa-solid fa-quote-right" style="color: #99600f;"></i>
                    </div>
                </div>

                <div class="card-product">
                    <div class="product_card--img">
                        <img src="{{ asset('img/personages/image-sarah.jpg') }}" alt="stamp-1864" draggable="false">
                    </div>
                    <h2>Gabriela</h2>
                    <div class="review__description">
                        <i class="fa-solid fa-quote-left" style="color: #99600f;"></i>
                        I was able to find a quality pre-owned vehicle that was perfect for my budget. The staff was honest and upfront about everything, making me feel confident in my purchase. I highly recommend this dealership!
                        <i class="fa-solid fa-quote-right" style="color: #99600f;"></i>
                    </div>
                </div>
            </div>
            <i id="right" class="fa-solid fas fa-angle-right"></i>
        </div>
    </div>
</section>


<!--Maps-->
<section class="find-us flex-center">
    <div class="structure">
        <h2>How To Find Us</h2>
        <div class="find-us-container">
            <div class="map-box block">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24117.41628755593!2d-0.11954335!3d51.50332435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761b33f112f109%3A0x57b99d92aa99d92f!2slastminute.com%20London%20Eye!5e0!3m2!1sen!2suk!4v1634146079449!5m2!1sen!2suk"
                    width="100%"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            </div>
            <div class="address-box block">
                <h3>Our Address</h3>
                <p>The United Kingdom —</p>
                <p>329 Queensberry Street,</p>
                <p>South London VIC 3051</p>
                <h3>Opening Hours</h3>
                <p>Monday – Friday: 09:00AM – 09:00PM</p>
                <p>Saturday: 09:00AM – 07:00PM</p>
                <p>Sunday: Closed</p>
                <button class="btn btn-no-bg">Plan Your Visit</button>
            </div>
        </div>
    </div>
</section>
</main>




<script>

document.addEventListener("DOMContentLoaded", function() {
const carousel = document.querySelector(".carousel");
const arrowBtns = document.querySelectorAll(".wrapper i");
const wrapper = document.querySelector(".wrapper");

const firstCard = carousel.querySelector(".card-product");
const firstCardWidth = firstCard.offsetWidth;

let isDragging = false,
    startX,
    startScrollLeft,
    timeoutId;

const dragStart = (e) => {
    isDragging = true;
    carousel.classList.add("dragging");
    startX = e.pageX;
    startScrollLeft = carousel.scrollLeft;
};

const dragging = (e) => {
    if (!isDragging) return;

    // Calculate the new scroll position
    const newScrollLeft = startScrollLeft - (e.pageX - startX);

    // Check if the new scroll position exceeds
    // the carousel boundaries
    if (newScrollLeft <= 0 || newScrollLeft >=
        carousel.scrollWidth - carousel.offsetWidth) {

        // If so, prevent further dragging
        isDragging = false;
        return;
    }

    // Otherwise, update the scroll position of the carousel
    carousel.scrollLeft = newScrollLeft;
};

const dragStop = () => {
    isDragging = false;
    carousel.classList.remove("dragging");
};

const autoPlay = () => {

    // Return if window is smaller than 800
    if (window.innerWidth < 800) return;

    // Calculate the total width of all cards
    const totalCardWidth = carousel.scrollWidth;

    // Calculate the maximum scroll position
    const maxScrollLeft = totalCardWidth - carousel.offsetWidth;

    // If the carousel is at the end, stop autoplay
    if (carousel.scrollLeft >= maxScrollLeft) return;

    // Autoplay the carousel after every 100ms
    timeoutId = setTimeout(() =>
        carousel.scrollLeft += firstCardWidth, 100);
};

carousel.addEventListener("mousedown", dragStart);
carousel.addEventListener("mousemove", dragging);
document.addEventListener("mouseup", dragStop);
wrapper.addEventListener("mouseenter", () =>
    clearTimeout(timeoutId));
wrapper.addEventListener("mouseleave", autoPlay);

// Add event listeners for the arrow buttons to
// scroll the carousel left and right
arrowBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        carousel.scrollLeft += btn.id === "left" ?
            -firstCardWidth : firstCardWidth;
    });
});
});



</script>



<script type="module" src="{{ asset('js/classes/initSlider.js')}}" defer></script>

@endsection
