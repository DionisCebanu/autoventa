@extends('layouts.app')
@section('title', 'Attributions')
@section('content')

<header class="header-img">
    <img src="{{ asset('img/gallery/collection.jpg') }}" alt="our collection">
    <div class="header-overlay typewriter">
        <h1>Attributions</h1>
    </div>
</header>
 <!--Header box-->
     <section class="filter-section">
        <div class="filter-container">
            <h3>The creators and licenses behind the images used in our work</h3>
        </div>
    </section>

    <!--Content -> Authors-->
    <main class="flex-center">
        <section class="structure">
            <section class="author-list grid-container">
                <article class="author-article">
                    <picture>
                        <img src="{{ asset('img/gallery/collection/bmw-m5.jpg') }}" alt="BMW M5">
                    </picture>
                    <div class="attribution-description">
                        <h3>Author: <span>leo_monsieur</span></h3>
                        <a href="https://pixabay.com/photos/vehicle-car-velocity-style-design-4044036/">The Link To the Source</a>
                    </div>
                </article>

                <article class="author-article">
                    <picture>
                        <img src="{{ asset('img/gallery/collection/audi-rs7.jpg') }}" alt="Audi RS7">
                    </picture>
                    <div class="attribution-description">
                        <h3>Author: <span>Toby_Parsons</span></h3>
                        <a href="https://pixabay.com/photos/audi-rs7-car-vehicle-auto-2996090/">The Link To the Source</a>
                    </div>
                </article>

                <article class="author-article">
                    <picture>
                        <img src="{{ asset('img/gallery/collection/mercedes-benz-amg-gt.jpg') }}" alt="Mercedes-Benz AMG GT">
                    </picture>
                    <div class="attribution-description">
                        <h3>Author: <span>VariousPhotography</span></h3>
                        <a href="https://pixabay.com/photos/mercedes-benz-car-amg-gt-transport-1474196/">The Link To the Source</a>
                    </div>
                </article>

                <article class="author-article">
                    <picture>
                        <img src="{{ asset('img/gallery/collection/ford-mustang.jpg') }}" alt="Ford Mustang">
                    </picture>
                    <div class="attribution-description">
                        <h3>Author: <span>domaxi198</span></h3>
                        <a href="https://pixabay.com/fr/photos/shelby-voiture-de-muscle-auto-3821711/">The Link To the Source</a>
                    </div>
                </article>

                <article class="author-article">
                    <picture>
                        <img src="{{ asset('img/gallery/audi.jpg') }}" alt="Audi RS6">
                    </picture>
                    <div class="attribution-description">
                        <h3>Author: <span>VariousPhotography</span></h3>
                        <a href="https://pixabay.com/photos/car-vehicle-transportation-system-3358500/">The Link To the Source</a>
                    </div>
                </article>

                <!-- Types Of Cars -->
                <article class="author-article">
                    <picture>
                        <img src="{{ asset('img/gallery/collection/types/suv.jpg') }}" alt="SUV Type">
                    </picture>
                    <div class="attribution-description">
                        <h3>Author: <span>pixabay.com</span></h3>
                        <a href="https://pixabay.com/fr/photos/mercedes-eqc-mercedes-ev-ev-4622242/">The Link To the Source</a>
                    </div>
                </article>

                <article class="author-article">
                    <picture>
                        <img src="{{ asset('img/gallery/collection/types/sedan.jpg') }}" alt="Sedan Type">
                    </picture>
                    <div class="attribution-description">
                        <h3>Author: <span>Pexels</span></h3>
                        <a href="https://pixabay.com/photos/asphalt-auto-automobile-automotive-1853590/">The Link To the Source</a>
                    </div>
                </article>

                <article class="author-article">
                    <picture>
                        <img src="{{ asset('img/gallery/collection/types/hatchback.jpg') }}" alt="Hatchback Type">
                    </picture>
                    <div class="attribution-description">
                        <h3>Author: <span>jarmoluk</span></h3>
                        <a href="https://pixabay.com/photos/car-audi-auto-automotive-vehicle-604019/">The Link To the Source</a>
                    </div>
                </article>

                <article class="author-article">
                    <picture>
                        <img src="{{ asset('img/gallery/collection/types/hybrid.jpg') }}" alt="Hybrid Type">
                    </picture>
                    <div class="attribution-description">
                        <h3>Author: <span>Joenomias</span></h3>
                        <a href="https://pixabay.com/photos/car-electric-car-hybrid-car-3117778/">The Link To the Source</a>
                    </div>
                </article>

                <article class="author-article">
                    <picture>
                        <img src="{{ asset('img/gallery/collection/types/coupe.jpg') }}" alt="Coupe Type">
                    </picture>
                    <div class="attribution-description">
                        <h3>Author: <span>Alexander Pöllinger</span></h3>
                        <a href="https://www.pexels.com/photo/red-sports-car-parked-on-dirt-road-14240209/">The Link To the Source</a>
                    </div>
                </article>

                <article class="author-article">
                    <picture>
                        <img src="{{ asset('img/gallery/collection.jpg') }}" alt="Collection Type">
                    </picture>
                    <div class="attribution-description">
                        <h3>Author: <span>Pixabay</span></h3>
                        <a href="https://www.pexels.com/photo/mercedes-benz-parked-in-a-row-164634/">The Link To the Source</a>
                    </div>
                </article>

                <!-- Logos -->
                <article class="author-article">
                    <picture>
                        <img src="{{ asset('img/logo/car-logo/audi-logo.png') }}" alt="Audi Logo">
                    </picture>
                    <div class="attribution-description">
                        <h3>Author: <span></span></h3>
                        <a href="https://www.cleanpng.com/png-audi-logo-with-four-rings-8301760/">The Link To the Source</a>
                    </div>
                </article>

                <article class="author-article">
                    <picture>
                        <img src="{{ asset('img/logo/car-logo/bmw-logo.png') }}" alt="BMW Logo">
                    </picture>
                    <div class="attribution-description">
                        <h3>Author: <span></span></h3>
                        <a href="https://www.cleanpng.com/png-2016-bmw-3-series-car-logo-motorcycle-decal-948331/">The Link To the Source</a>
                    </div>
                </article>

                <article class="author-article">
                    <picture>
                        <img src="{{ asset('img/logo/car-logo/ford-logo.png') }}" alt="Ford Logo">
                    </picture>
                    <div class="attribution-description">
                        <h3>Author: <span></span></h3>
                        <a href="https://www.cleanpng.com/png-ford-motor-company-logo-car-ford-focus-6411162/">The Link To the Source</a>
                    </div>
                </article>

                <article class="author-article">
                    <picture>
                        <img src="{{ asset('img/logo/car-logo/volkswagen-logo.png') }}" alt="Volkswagen Logo">
                    </picture>
                    <div class="attribution-description">
                        <h3>Author: <span></span></h3>
                        <a href="https://www.cleanpng.com/png-volkswagen-group-wolfsburg-car-logo-volkswagen-png-115469/">The Link To the Source</a>
                    </div>
                </article>

                <article class="author-article">
                    <picture>
                        <img src="{{ asset('img/logo/car-logo/mercedes-logo.png') }}" alt="Mercedes Logo">
                    </picture>
                    <div class="attribution-description">
                        <h3>Author: <span>cleanpng.com</span></h3>
                        <a href="https://www.cleanpng.com/png-mercedes-benz-mb100-car-mercedes-benz-a-class-daim-758197/">The Link To the Source</a>
                    </div>
                </article>

                <!-- Car Self -->
                <article class="author-article">
                    <picture>
                        <img src="{{ asset('img/gallery/collection/mercedes/c-class-2.jpg') }}" alt="Mercedes C-Class">
                    </picture>
                    <div class="attribution-description">
                        <h3>Author: <span></span></h3>
                        <a href="https://pixabay.com/photos/mercedes-benz-car-white-white-car-841465/">The Link To the Source</a>
                    </div>
                </article>

                <article class="author-article">
                    <picture>
                        <img src="{{ asset('img/gallery/collection/mercedes/c-class-3.jpg') }}" alt="Mercedes C-Class">
                    </picture>
                    <div class="attribution-description">
                        <h3>Author: <span>whodol</span></h3>
                        <a href="https://pixabay.com/photos/inside-%D1%81%D1%84%D0%BA-car-automatic-mercedes-820896/">The Link To the Source</a>
                    </div>
                </article>

                <article class="author-article">
                    <picture>
                        <img src="{{ asset('img/gallery/collection/mercedes/c-class-4.jpg') }}" alt="Mercedes C-Class">
                    </picture>
                    <div class="attribution-description">
                        <h3>Author: <span>AutoPhotography</span></h3>
                        <a href="https://pixabay.com/photos/mercedes-benz-car-auto-transport-3392793/">The Link To the Source</a>
                    </div>
                </article>

                <article class="author-article">
                    <picture>
                        <img src="{{ asset('img/gallery/collection/mercedes/c-class-5.jpg') }}" alt="Mercedes C-Class">
                    </picture>
                    <div class="attribution-description">
                        <h3>Author: <span>AutoPhotography</span></h3>
                        <a href="https://pixabay.com/photos/mercedes-benz-car-auto-transport-3585098/">The Link To the Source</a>
                    </div>
                </article>

                <!-- Persons -->
                <article class="author-article">
                    <picture>
                        <img src="{{ asset('img/personages/image-sarah.jpg') }}" alt="Person">
                    </picture>
                    <div class="attribution-description">
                        <h3>Author: <span>Daniel Xavier</span></h3>
                        <a href="https://www.pexels.com/photo/woman-wearing-black-eyeglasses-1239291/">The Link To the Source</a>
                    </div>
                </article>
            </section>

        </section>
    </main>

@endsection
