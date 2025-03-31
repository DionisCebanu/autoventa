document.getElementById('make').addEventListener('change', function () {
    const make = this.value;
    const modelSelect = document.getElementById('model');
    const yearSelect = document.getElementById('year');

    // Reset les anciens modèles et années
    modelSelect.innerHTML = '<option value="" disabled selected>Models</option>';
    yearSelect.innerHTML = '<option value="" disabled selected>Year</option>';

    if (!make) return;

    fetch(`/api/cars/options?make=${make}`)
        .then(res => res.json())
        .then(data => {
            data.models.forEach(model => {
                const opt = document.createElement('option');
                opt.value = model;
                opt.textContent = model;
                modelSelect.appendChild(opt);
            });
        });
});

document.getElementById('model').addEventListener('change', function () {
    const make = document.getElementById('make').value;
    const model = this.value;
    const yearSelect = document.getElementById('year');

    // Reset les anciennes années
    yearSelect.innerHTML = '<option value="" disabled selected>Year</option>';

    if (!make || !model) return;

    fetch(`/api/cars/options?make=${make}&model=${model}`)
        .then(res => res.json())
        .then(data => {
            data.years.forEach(year => {
                const opt = document.createElement('option');
                opt.value = year;
                opt.textContent = year;
                yearSelect.appendChild(opt);
            });
        });
});



document.addEventListener('DOMContentLoaded', () => {
    const filterForm = document.getElementById('filter-form');
    const carResultsContainer = document.querySelector('#car-results');

    filterForm.addEventListener('submit', handleFilterSubmit);

    /**
     * 
     * @param {OPTION OF THE SORT BOX} e 
     */
    document.querySelectorAll('.sortbox-list input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', () => {
            document.getElementById('filter-form').dispatchEvent(new Event('submit'));
        });
    });

    function handleFilterSubmit(e) {
        e.preventDefault();

        const filters = getFilters();
        fetchFilteredCars(filters);
    }

    function getFilters() {
        return {
            make: document.getElementById('make').value,
            model: document.getElementById('model').value,
            year: document.getElementById('year').value,
            sort: document.querySelector('.sortbox-list input[type="radio"]:checked')?.id || 'default'
        };
    }

    function fetchFilteredCars({ make, model, year, sort }) {
        const query = new URLSearchParams({ make, model, year, sort }).toString();

        fetch(`/api/cars/filter?${query}`)
            .then(res => res.json())
            .then(cars => {
                renderCars(cars);
            })
            .catch(err => console.error('Erreur lors de la récupération des voitures filtrées :', err));
    }

    function renderCars(cars) {
        carResultsContainer.innerHTML = '';

        if (cars.length === 0) {
            carResultsContainer.innerHTML = '<p>Aucun véhicule trouvé.</p>';
            return;
        }

        cars.forEach(car => {
            const image = car.images?.[0]?.image_path ?? '/img/gallery/collection/default-image/default.jpg';

            const cardHTML = `
                <div class="card-car">
                    <div class="card-car-img">
                        <img src="${image}" alt="${car.make} ${car.model}">
                        <div class="type-car">
                            <p>${car.type}</p>
                        </div>
                    </div>
                    <div class="card-car-description">
                        <div class="car-description-price">
                            <span>${parseFloat(car.price).toLocaleString('en-UK', { minimumFractionDigits: 2 })}£</span>
                            <h2>${car.make} ${car.model} ${car.year}</h2>
                        </div>
                    </div>
                    <div class="card-car-footer">
                        ${renderCarFooter(car)}
                    </div>
                    <div class="card-car-button">
                        <a href="/car/${car.id}">VIEW DETAILS <i>→</i></a>
                    </div>
                </div>
            `;

            carResultsContainer.insertAdjacentHTML('beforeend', cardHTML);
        });
    }

    function renderCarFooter(car) {
        return `
            <div class="card-car-footer__item flex-al gap10">
                <i class="fa-solid fa-gas-pump"></i>
                <div class="card--footer-item__desc">
                    <span>Fuel Type</span>
                    <p>${car.fuel_type}</p>
                </div>
            </div>
            <div class="vertical-line"></div>
            <div class="card-car-footer__item flex-al gap10">
                <i class="fa-solid fa-road"></i>
                <div class="card--footer-item__desc">
                    <span>Mileage</span>
                    <p>${parseInt(car.mileage).toLocaleString()} km</p>
                </div>
            </div>
            <div class="vertical-line"></div>
            <div class="card-car-footer__item flex-al gap10">
                <i class="fa-solid fa-gears"></i>
                <div class="card--footer-item__desc">
                    <span>Transmission</span>
                    <p>${car.transmission}</p>
                </div>
            </div>
        `;
    }
});
