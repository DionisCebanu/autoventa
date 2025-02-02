<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Dionis">
     <title> @yield('title')</title>
    <link href="{{ asset('css/style.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script type="module" src="{{ asset('js/main.js')}}" defer></script>
</head>
<body>
    <div class="loader"></div>
    <nav>

        <div class="logo">
            <a href="/">
                <div class="logo-img"><img src="{{asset('img/logo/autoventa-logo.png') }}" alt="logo autoventa"></div>
            </a>
        </div>
        <div class="page-links">
            <a class="nav-btn" href="/about">About</a>
            <a class="nav-btn" href="/catalog">Catalog</a>
            <a class="nav-btn" href="/attributions">Attributions</a>
        </div>
        <div class="contact-us">
            <div class="contact-us">
            @if (session()->has('user_name'))
                <div class="greet-user">
                    <p>Welcome, <span>{{ session('user_name') }}</span></p>
                    <div class="greet-user-img"><a href="/profile"><img src="{{asset('img/nav/profile.png') }}" alt="profile"></a></div>
                </div>
                <!-- Logout button -->
                <!-- <form action="{{ route('auth.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-no-bg">Logout</button>
                </form> -->
            @else
                <!-- Login button -->
                <a href="{{ route('login') }}" class="btn btn-no-bg">Login</a>
                <!-- Contact Us button -->
                <a href="/contact" class="btn">Contact Us</a>
            @endif

        </div>
        </div>

        <div class="hamburger">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </div>

        <div class="dropdown_menu">
            @if (session()->has('user_name'))
                    <div class="greet-user-mobile">
                        <p>Welcome, <span>{{ session('user_name') }}</span></p>
                        <div class="greet-user-img"><a href="/profile"><img src="{{asset('img/nav/profile.png') }}" alt="profile"></a></div>
                    </div>
            @else
                <!-- Login button -->
                <a href="{{ route('login') }}" class="btn btn-no-bg">Login</a>
            @endif
            <li><a href="/" role="menuitem">Home</a></li>
            <li><a href="/about" role="menuitem">About</a></li>
            <li><a href="/catalog" role="menuitem">Catalog</a></li>
            <li><a href="/contact" role="menuitem">Contact</a></li>
            <!-- <div class="dropdown_menu--connection">
                <a class="btn" href="/login">Authentification</a>
            </div> -->
           
        </div>
    </nav>
    @if (session('success'))
        <div class="alert success">
            {{ session('success') }}
            <button type="button" class="btn-close">X</button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert error">
            {{ session('error') }}
            <button type="button" class="btn-close">X</button>
        </div>
    @endif
    <!-- Content -->
    @yield('content')
    <!--Footer-->

   <footer class="footer-section flex-column-center">
    <div class="structure">
        <div class="footer-logo flex">
            <div class="footer-logo--img">
                <img src="{{asset('img/logo/autoventa-logo.png') }}" alt="autoventa logo">
            </div>
            <div class="footer--logo__title">
                Aut<span>o</span>venta
            </div>
        </div>
        <div class="footer-container">
            <div class="footer-column">

                <div class="footer-description">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quibusdam debitis minus illum aliquid et voluptas.</p>
                </div>
                <div class="footer-contact-icons">
                    <div class="flex gap20">
                        <i class="fa-solid fa-phone"></i>
                        <span>+44 20 7123 4567</span>
                    </div>
                    <div class="flex gap20">
                        <i class="fa-solid fa-location-crosshairs"></i>
                        <span>489 King Street, London, UK</span>
                    </div>
                    <div class="flex gap20">
                        <i class="fa-solid fa-inbox"></i>
                        <span>autoventa@autoventa.uk</span>
                    </div>
                </div>
            </div>
            <div class="footer-column">
                <div class="footer--column__header">
                    Quick Links
                </div>
                <div class="footer--column__links">
                    <a href="#"><i class="fas fa-caret-right"></i> About Us</a>
                    <a href="#"><i class="fas fa-caret-right"></i> Link2</a>
                    <a href="#"><i class="fas fa-caret-right"></i> Link3</a>
                    <a href="#"><i class="fas fa-caret-right"></i> Link4</a>
                </div>
            </div>
            <div class="footer-column">
                <div class="footer--column__header">
                    Support Center
                </div>
                <div class="footer--column__links">
                    <a href="#"><i class="fas fa-caret-right"></i> About Us</a>
                    <a href="#"><i class="fas fa-caret-right"></i> Link2</a>
                    <a href="#"><i class="fas fa-caret-right"></i> Link3</a>
                    <a href="#"><i class="fas fa-caret-right"></i> Link4</a>
                </div>
            </div>
            <div class="footer-column">
                <div class="footer--column__header">
                    Newsletter
                </div>
                <h3 class="mb-10">
                    Subscribe Our Newsletter To Get Latest Update And News
                </h3>
                <div class="footer--newsletter">
                    <input type="text" class="newsletter-input" placeholder="youremail@example.com">
                    <button class="btn newsletter-btn" type="submit">
                        Subscribe Now <i class="far fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <p>© Copyright 2024 <span>Autoventa</span> All Rights Reserved.</p>
        <div class="footer-social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
</footer>

<body>
<!-----General script for modules------>
<script>
        document.addEventListener("DOMContentLoaded", () => {
        const closeButtons = document.querySelectorAll(".btn-close");

        closeButtons.forEach(button => {
            button.addEventListener("click", function () {
                const alert = this.parentElement;
                alert.classList.add("hide");
            });
        });
    });
</script>
</body>
</html>
