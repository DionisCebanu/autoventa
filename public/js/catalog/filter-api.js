document.querySelectorAll('.custom-select').forEach(select => {
    const name = select.dataset.name;
    const selected = select.querySelector('.select-selected');
    const options = select.querySelector('.select-options');
    const input = select.querySelector('input');

    selected.addEventListener('click', () => {
        document.querySelectorAll('.select-options').forEach(opt => {
            if (opt !== options) opt.style.display = 'none';
        });
        options.style.display = options.style.display === 'block' ? 'none' : 'block';
    });

    options.querySelectorAll('li').forEach(option => {
        option.addEventListener('click', () => {
            selected.textContent = option.textContent;
            input.value = option.dataset.value;
            options.style.display = 'none';

            // 👉 ONLY if it's the 'make' dropdown, fetch models
            if (name === 'make') {
                fetchModels(option.dataset.value);
            }

            // 👉 If it's the 'model' dropdown, fetch years
            if (name === 'model') {
                const makeValue = document.querySelector('input[name="make"]').value;
                fetchYears(makeValue, option.dataset.value);
            }
        });
    });
});

/**
 * 
 * @param {Make} make 
 * @RETURN {model}
 */

function fetchModels(make) {
    const modelSelect = document.querySelector('.custom-select[data-name="model"]');
    const modelList = modelSelect.querySelector('.select-options');
    const modelSelected = modelSelect.querySelector('.select-selected');
    const modelInput = modelSelect.querySelector('input');

    // Reset
    modelList.innerHTML = '';
    modelSelected.textContent = 'Models';
    modelInput.value = '';

    const yearSelect = document.querySelector('.custom-select[data-name="year"]');
    yearSelect.querySelector('.select-options').innerHTML = '';
    yearSelect.querySelector('.select-selected').textContent = 'Years';
    yearSelect.querySelector('input').value = '';

    fetch(`/api/cars/options?make=${make}`)
        .then(res => res.json())
        .then(data => {
            data.models.forEach(model => {
                const li = document.createElement('li');
                li.dataset.value = model;
                li.textContent = model;
                li.addEventListener('click', () => {
                    modelSelected.textContent = model;
                    modelInput.value = model;
                    modelList.style.display = 'none';
                    fetchYears(make, model); 
                });
                modelList.appendChild(li);
            });
        });
}


/**
 * 
 * @param {make, model} 
 * @RETURN {YEAR}
 */
function fetchYears(make, model) {
    const yearSelect = document.querySelector('.custom-select[data-name="year"]');
    const yearList = yearSelect.querySelector('.select-options');
    const yearSelected = yearSelect.querySelector('.select-selected');
    const yearInput = yearSelect.querySelector('input');

    yearList.innerHTML = '';
    yearSelected.textContent = 'Years';
    yearInput.value = '';

    fetch(`/api/cars/options?make=${make}&model=${model}`)
        .then(res => res.json())
        .then(data => {
            data.years.forEach(year => {
                const li = document.createElement('li');
                li.dataset.value = year;
                li.textContent = year;
                li.addEventListener('click', () => {
                    yearSelected.textContent = year;
                    yearInput.value = year;
                    yearList.style.display = 'none';
                });
                yearList.appendChild(li);
            });
        });
}


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


