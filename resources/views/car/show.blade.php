@extends('layouts.app')
@section('title', 'Details')
@section('content')


 <main class="flex-center">
        <div class="structure">

           <header class="flex gap30">
               <div class="gallery-container">
                    <div class="main-image">
                        <button class="carousel-btn prev-btn">&lt;</button>
                        <img 
                            src="{{ $car->images->first() ? Storage::url($car->images->first()->image_path) : asset('img/gallery/collection/default-car.jpg') }}" 
                            alt="Main Car Image" 
                            id="main-image"
                        >
                        <button class="carousel-btn next-btn">&gt;</button>
                    </div>

                   <div class="car_details_images-grid">
                    @foreach ($car->images as $index => $image)
                        @if ($index < 4)
                            <div class="car_detail_image">
                                <img src="{{ Storage::url($image->image_path) }}" alt="Thumbnail {{ $index + 1 }}">
                            </div>
                        @else
                            <div class="car_detail_image">
                                <div class="car_detail_image-overlay">
                                    <span>Images ({{ $car->images->count() }})</span>
                                    <img src="{{ Storage::url($image->image_path) }}" alt="Thumbnail {{ $index + 1 }}">
                                </div>
                            </div>
                            @break
                        @endif
                    @endforeach
                    </div>

               </div>
           </header>
            <section>
                <div class="car-details-header">
                    <header class="car-header">
                        <h1>{{ $car->make }} {{ $car->model }}</h1>
                        <div class="car-header-items flex-al gap20">
                            <div class="">
                                <span>{{ $car->year }}</span>
                            </div>
                            <div class="dot"></div>
                            <div>
                                <span>{{ $car->type }}</span>
                            </div>
                            <div class="dot"></div>
                            <div>
                                <span>{{ $car->fuel_type }}</span>
                            </div>
                        </div>
                        <div class="price">
                            <span>{{ number_format($car->price, 2) }} (£)</span>
                        </div>
                        <div class="line"></div>
                    </header>

                    <div class="car-details-container">
                        <div class="car-detail-description">
                            <h2>Description:</h2>
                            <p>{{ $car->description ?? "Discover the perfect blend of performance, style, and comfort with this exceptional vehicle. Engineered for drivers who appreciate both reliability and innovation, it offers a smooth, responsive driving experience whether you're navigating city streets or exploring the open road. Inside, you'll find a thoughtfully designed interior that prioritizes both functionality and luxury, featuring cutting-edge technology and premium materials. With impressive fuel efficiency, advanced safety features, and a sleek, modern exterior, this car is built to meet your needs while exceeding your expectations. Experience the freedom and confidence of driving a car that is as versatile as your lifestyle." }}</p>
                        </div>
                        <div class="car-details-list-box block">
                        <div class="car-details-list-item">
                            <strong><div class="dot"></div> Make:</strong><span>{{ $car->make }}</span>
                        </div>
                        <div class="car-details-list-item">
                            <strong><div class="dot"></div> Model:</strong><span>{{ $car->model }}</span>
                        </div>
                        <div class="car-details-list-item">
                            <strong><div class="dot"></div> Year:</strong><span>{{ $car->year }}</span>
                        </div>
                        <div class="car-details-list-item">
                            <strong><div class="dot"></div> Color:</strong><span>{{ $car->color ?? 'Not specified' }}</span>
                        </div>
                        <div class="car-details-list-item">
                            <strong><div class="dot"></div> Transmission:</strong><span>{{ $car->transmission }}</span>
                        </div>
                        <div class="car-details-list-item">
                            <strong><div class="dot"></div> Condition:</strong><span>{{ $car->car_condition }}</span>
                        </div>
                        <div class="car-details-list-item">
                            <strong><div class="dot"></div> Fuel Type:</strong><span>{{ $car->fuel_type }}</span>
                        </div>
                        <div class="car-details-list-item">
                            <strong><div class="dot"></div> VIN:</strong><span>{{ $car->vin }}</span>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="loan-calculator-box block">
                    <div class="loan-box-header">
                        <i class="fa-solid fa-calculator"></i>
                        <h2>Financing Calculator</h2>
                    </div>
                    <div>
                        <div class="loan-header">
                            <label for="price">Vehicle Price <span>(£)</span></label>
                            <input type="text" name="price">
                        </div>
                        <div class="loan-header">
                            <label for="down_payment">Down Payment <span>(£)</span></label>
                            <input type="text" name="down_payment">
                        </div>
                    </div>

                    <div>
                        <div class="loan-header">
                            <label for="interest">Interest Rate <span>(%)</span></label>
                            <input type="text" name="interest">
                        </div>
                        <div class="loan-header">
                            <label for="loan_term">Loan Term <span>(month)</span></label>
                            <input type="text" name="loan_term">
                        </div>
                    </div>

                    <div class="calculate-btn">
                        <button class="btn">Calculate</button>
                    </div>
                </div>
            </section>

            <section>
                    <h2 class="mb-20">How To Find Us</h2>
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
            </section>

        </div>
    </main>


    <script>
    // Array of all image paths for the carousel
    const images = @json($car->images->map(fn($image) => Storage::url($image->image_path))->toArray());

    // Current image index
    let currentIndex = 0;

    // DOM elements
    const mainImage = document.getElementById("main-image");
    const prevButton = document.querySelector(".prev-btn");
    const nextButton = document.querySelector(".next-btn");
    const detailImages = document.querySelectorAll(".car_detail_image img");

    // Function to update the main image
    function updateImage(index) {
        mainImage.src = images[index];
    }

    // Event listeners for carousel buttons
    prevButton.addEventListener("click", () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateImage(currentIndex);
    });

    nextButton.addEventListener("click", () => {
        currentIndex = (currentIndex + 1) % images.length;
        updateImage(currentIndex);
    });

    // Event listeners for detail images
    detailImages.forEach((img, index) => {
        img.addEventListener("click", () => {
            currentIndex = index;
            updateImage(currentIndex);
        });
    });
</script>


@endsection
