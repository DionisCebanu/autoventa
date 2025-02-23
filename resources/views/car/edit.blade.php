@extends('layouts.app')
@section('title', 'Edit the Car')
@section('content')

<main class="flex-center">
    <section class="structure">
    <form class="container-form_sides" action="{{ route('car.update', $car->id) }}" method="POST">
    @csrf
    @method('PUT') <!-- Use PUT for updating -->
    <div class="image_container">
        <!-- Main Image Section -->
        <div class="main-image-section">
            <h3>Main Image</h3>
            <div class="upload-box">
                <img id="main-image-preview" 
                    src="{{ old('main_image_url', $car->images->firstWhere('is_main', true)?->image_path ?? asset('img/administration/upload.png')) }}" 
                    alt="Upload Icon">
                <input type="text" 
                    name="main_image_url" 
                    id="main_image_url" 
                    placeholder="Enter Google Drive image link" 
                    value="{{ old('main_image_url', $car->images->firstWhere('is_main', true)?->image_path) }}"
                    oninput="previewMainImage()">
                @error('main_image_url')
                    <div class="error_field">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Additional Images Section -->
        <div class="additional-images-section">
            <h3>Additional Images</h3>
            <div class="thumbnails" id="additional-thumbnails">
                @php
                    $additionalImages = old('additional_images_urls', $car->images->where('is_main', false)->pluck('image_path')->toArray());
                @endphp

                @for ($i = 0; $i < 4; $i++)
                    <div class="thumbnail" id="thumbnail-{{ $i }}">
                        <img id="thumbnail-upload-{{ $i }}" 
                             src="{{ isset($additionalImages[$i]) ? $additionalImages[$i] : asset('img/administration/upload.png') }}" 
                             alt="Additional Image">
                        <img id="thumbnail-success-{{ $i }}" 
                             src="{{ isset($additionalImages[$i]) ? $additionalImages[$i] : asset('img/administration/upload-success.png') }}" 
                             alt="Additional Image" 
                             style="display: {{ isset($additionalImages[$i]) ? 'block' : 'none' }};">
                    </div>
                @endfor
            </div>
            <div class="additional_images_input flex-col gap20">
                @for ($i = 0; $i < 4; $i++)
                    <input type="text"
                        name="additional_images_urls[]"
                        placeholder="Enter additional Google Drive image link"
                        value="{{ isset($additionalImages[$i]) ? $additionalImages[$i] : '' }}"
                        id="additional-input-{{ $i }}"
                        oninput="updateThumbnail({{ $i }})">
                    @error('additional_images_urls.' . $i)
                        <div class="error_field">{{ $message }}</div>
                    @enderror
                @endfor
            </div>
        </div>
    </div>

    <div class="form-container">
        <section class="car-form">
            <!-- Left Section -->
            <section class="left-side">
                <div class="form-group">
                    <label for="make">Make:</label>
                    <input type="text" id="make" name="make" value="{{ old('make', $car->make) }}" placeholder="Select the make of the car">
                    @error('make')
                        <div class="error_field">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="model">Model:</label>
                    <input type="text" id="model" name="model" value="{{ old('model', $car->model) }}" placeholder="Select the model of the car">
                    @error('model')
                        <div class="error_field">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="year">Year:</label>
                    <input type="number" id="year" name="year" value="{{ old('year', $car->year) }}" placeholder="Select the year of the car">
                    @error('year')
                        <div class="error_field">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="type">Type:</label>
                    <select id="type" name="type">
                        <option value="SUV" {{ old('type', $car->type) == 'SUV' ? 'selected' : '' }}>SUV</option>
                        <option value="SEDAN" {{ old('type', $car->type) == 'SEDAN' ? 'selected' : '' }}>SEDAN</option>
                        <option value="Coupe" {{ old('type', $car->type) == 'Coupe' ? 'selected' : '' }}>Coupe</option>
                    </select>
                    @error('type')
                        <div class="error_field">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                        <label for="transmission">Transmission:</label>
                        <select id="transmission" name="transmission">
                            <option value="Automatic" {{ old('transmission') == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                            <option value="Manual" {{ old('transmission') == 'Manual' ? 'selected' : '' }}>Manual</option>
                        </select>
                        @error('transmission')
                            <div class="error_field">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="fuel-type">Fuel Type:</label>
                        <select id="fuel-type" name="fuel_type">
                            <option value="Diesel" {{ old('fuel_type') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                            <option value="Petrol" {{ old('fuel_type') == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                            <option value="Hybrid" {{ old('fuel_type') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                            <option value="Electric" {{ old('fuel_type') == 'Electric' ? 'selected' : '' }}>Electric</option>
                        </select>
                        @error('fuel_type')
                            <div class="error_field">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="mileage">Mileage:</label>
                        <input type="number" id="mileage" name="mileage"  value="{{ old('mileage', $car->mileage) }}" placeholder="Integer only, ex: (150000)">
                        @error('mileage')
                            <div class="error_field">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="fuel-efficiency">Fuel Efficiency (Per 100 km):</label>
                        <input type="number" id="fuel-efficiency" name="fuel_efficiency" value="{{ old('fuel_efficiency', $car->fuel_efficiency) }}" placeholder="Integer only, ex: (9.5)" step="0.1">
                        @error('fuel_efficiency')
                            <div class="error_field">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="engine-size">Engine Size:</label>
                        <input type="number" id="engine-size" name="engine_size" value="{{ old('engine_size', $car->engine_size) }}" placeholder="Integer only, ex: (2.5)" step="0.1">
                        @error('engine_size')
                            <div class="error_field">{{ $message }}</div>
                        @enderror
                    </div>
                <!-- Repeat similar blocks for other fields like transmission, fuel type, etc. -->
            </section>
            
            <!-- Right Section -->
            <section class="right-side">
                    <div class="form-group">
                        <label for="horsepower">Horsepower:</label>
                        <input type="number" id="horsepower" name="horsepower" value="{{ old('horsepower', $car->horsepower) }}" placeholder="Integer only, ex: (150)">
                        @error('horsepower')
                            <div class="error_field">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" id="price" name="price"  value="{{ old('price', $car->price) }}" placeholder="Integer only, ex: (12000)">
                        @error('price')
                            <div class="error_field">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="vin">VIN:</label>
                        <input type="text" id="vin" name="vin" value="{{ old('vin', $car->vin) }}" placeholder="ex: 1VXBR12EXCP901213">
                        @error('vin')
                            <div class="error_field">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="availability-status">Availability Status:</label>
                        <select id="availability-status" name="availability_status">
                            <option value="Sold" {{ old('availability_status') == 'Sold' ? 'selected' : '' }}>Sold</option>
                            <option value="Available" {{ old('availability_status') == 'Available' ? 'selected' : '' }}>Available</option>
                            <option value="Coming" {{ old('availability_status') == 'Coming' ? 'selected' : '' }}>Coming</option>
                            <option value="Reserved" {{ old('availability_status') == 'Reserved' ? 'selected' : '' }}>Reserved</option>
                        </select>
                        @error('availability_status')
                            <div class="error_field">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="seat-capacity">Seat Capacity:</label>
                        <input type="number" id="seat-capacity" name="seat_capacity" value="{{ old('seat_capacity', $car->seat_capacity) }}" placeholder="Integer only, ex: (5)">
                        @error('seat_capacity')
                            <div class="error_field">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="drive-type">Drive Type:</label>
                        <select id="drive-type" name="drive_type">
                            <option value="FWD" {{ old('drive_type', $car->drive_type) == 'FWD' ? 'selected' : '' }}>FWD</option>
                            <option value="RWD" {{ old('drive_type', $car->drive_type) == 'RWD' ? 'selected' : '' }}>RWD</option>
                            <option value="AWD" {{ old('drive_type', $car->drive_type) == 'AWD' ? 'selected' : '' }}>AWD</option>
                            <option value="4WD" {{ old('drive_type', $car->drive_type) == '4WD' ? 'selected' : '' }}>4WD</option>
                        </select>
                        @error('drive_type')
                            <div class="error_field">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="car-condition">Car Condition:</label>
                        <select id="car-condition" name="car_condition">
                            <option value="New" {{ old('car_condition', $car->car_condition) == 'New' ? 'selected' : '' }}>New</option>
                            <option value="Used" {{ old('car_condition', $car->car_condition) == 'Used' ? 'selected' : '' }}>Used</option>
                            <option value="Certified" {{ old('car_condition', $car->car_condition) == 'Certified' ? 'selected' : '' }}>Certified</option>
                        </select>
                        @error('car_condition')
                            <div class="error_field">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="submit-button">Update The Car</button>
                </section>
        </section>
    </div>

</form>

    </section>
</main>



<script>
    function previewMainImage() {
        const input = document.getElementById("main_image_url");
        const preview = document.getElementById("main-image-preview");

        if (input.value.trim() !== "") {
            // Switch to the success image if input has a value
            preview.src = "{{ asset('img/administration/upload-success.png') }}";
        } else {
            // Switch to the default image if input is empty
            preview.src = "{{ asset('img/administration/upload.png') }}";
        }
    }

    function updateThumbnail(index) {
        const input = document.getElementById(`additional-input-${index}`);
        const uploadImg = document.getElementById(`thumbnail-upload-${index}`);
        const successImg = document.getElementById(`thumbnail-success-${index}`);

        if (input.value.trim() !== "") {
            // If input has a value, show the "success" thumbnail and hide "upload"
            uploadImg.style.display = "none";
            successImg.style.display = "block";
        } else {
            // If input is empty, show the "upload" thumbnail and hide "success"
            uploadImg.style.display = "block";
            successImg.style.display = "none";
        }
    }

// Initialize thumbnails based on pre-filled values
    document.addEventListener("DOMContentLoaded", () => {
        const totalInputs = 4; // Number of inputs
        for (let i = 0; i < totalInputs; i++) {
            updateThumbnail(i); // Initialize each thumbnail based on input value
        }
    });
    document.addEventListener("DOMContentLoaded", () => {
        previewMainImage(); // Ensure the correct preview image is displayed
    });

</script>
@endsection