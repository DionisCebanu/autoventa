@extends('layouts.app')
@section('title', 'Contact Us')
@section('content')
  <main>
        <!---FORM-->
        <section class="flex-center mb-20">
            <div class="structure flex-center">
            <form class="form" action="{{ route('contact.store') }}" method="POST">
            @csrf
            <div class="form-control">
                <label for="name">Name:</label>
                <input type="text" name="name" placeholder="Enter your name" required>
            </div>
            <div class="form-control">
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-control">
                <label for="phone">Phone:</label>
                <input type="tel" name="phone" placeholder="Enter your phone" required>
            </div>
            <div class="form-control">
                <label for="message">Message:</label>
                <textarea name="message" placeholder="Write your message..." required></textarea>
            </div>
            <button class="btn btn-icon" type="submit">Send <i class="fas fa-paper-plane"></i></button>
            </form>
            </div>
        </section>
        <!--Location--->
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


@endsection
