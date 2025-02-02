@extends('layouts.app')
@section('title', 'About')
@section('content')

 <!--Content-->
 <main class="flex-center">
        <section class="structure">
            <!--About Us-->
            <article class="about-us">
                <aside class="about-us_title">
                    <h1>Who Are We?</h1>
                </aside>
                <aside class="about-us_description">
                    <p>At Autoventa, we are committed to making your car-buying experience seamless and enjoyable. With a wide selection of high-quality vehicles, we focus on offering personalized service to help you find the perfect car that suits your needs and budget. Our knowledgeable team is dedicated to ensuring you drive away with confidence, offering expert advice, flexible financing options, and ongoing support. At Autoventa, your satisfaction is our priority, and we aim to exceed your expectations every step of the way.</p>
                    <a href="/catalog" class="btn">Explore the cars</a>
                </aside>
            </article>
            <!---Testimonials-->
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
        </section>
    </main>

     <!--Gallery-->
     <section>
        <div class="gallery">
            <div class="gallery-item item1 block">
                <img src="{{ asset('img/gallery/mercedes.jpg') }}" alt="Mercedes">
            </div>
            <div class="gallery-item item2 block">
                <img src="{{ asset('img/gallery/rangerover.jpg') }}" alt="Range Rover">
            </div>
            <div class="gallery-item item3 block">
                <img src="{{ asset('img/gallery/consultant2.jpg') }}" alt="Consultant">
            </div>
            <div class="gallery-item item4 block">
                <img src="{{ asset('img/gallery/consultant3.jpg') }}" alt="Consultant">
            </div>
            <div class="gallery-item item5 block">
                <img src="{{ asset('img/gallery/collection.jpg') }}" alt="Collection">
            </div>
            <div class="gallery-item item6 block">
                <img src="{{ asset('img/gallery/consultant4.jpg') }}" alt="Consultant">
            </div>
            <div class="gallery-item item7 block">
                <img src="{{ asset('img/gallery/audi.jpg') }}" alt="Audi">
            </div>
            <div class="gallery-item item8 block">
                <img src="{{ asset('img/gallery/consultant1.jpg') }}" alt="Consultant">
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

@endsection