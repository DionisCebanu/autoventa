document.getElementById('filter-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const make = document.getElementById('make').value;
    const model = document.getElementById('model').value;
    const year = document.getElementById('year').value;

    fetch(`/api/cars/filter?make=${make}&model=${model}&year=${year}`)
        .then(res => res.json())
        .then(cars => {
            const container = document.querySelector('#car-results');
            container.innerHTML = ''; // Vide les anciens résultats

            if (cars.length === 0) {
                container.innerHTML = '<p>Aucun véhicule trouvé.</p>';
                return;
            }

            cars.forEach(car => {
                const image = car.images?.[0]?.image_path ?? '/img/gallery/collection/default-image/default.jpg';

                container.innerHTML += `
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
                        </div>
                        <div class="card-car-button">
                            <a href="/car/${car.id}">VIEW DETAILS <i>→</i></a>
                        </div>
                    </div>
                `;
            });
        })
        .catch(err => {
            console.error('Erreur lors de la récupération des voitures filtrées :', err);
        });
});