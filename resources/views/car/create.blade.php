@extends('layouts.app')
@section('title', 'Add a new Car')
@section('content')

<main class="flex-center">
    <section class="structure">
        <form class="container-form_sides" action="{{ route('car.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="image_container">
    <!-- Main Image Section -->
    <div class="main-image-section">
        <h3>Main Image</h3>
        <div class="upload-box">
            <img 
                src="{{ session('main_image_temp') ? Storage::url(session('main_image_temp')) : asset('img/administration/upload.png') }}" 
                alt="Main Image Preview" 
                class="upload-icon" 
                
                id="main-image-preview"
            >
            <input 
                class="browse-button" 
                type="file" 
                name="main_image" 
                id="main_image" 
                onchange="previewImage(event, 'main-image-preview')"
            >
            <input type="hidden" name="main_image_temp" value="{{ session('main_image_temp') }}">
            @error('main_image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Additional Images Section -->
    <div class="additional-images-section">
        <h3>Additional Images</h3>
        <div class="thumbnails">
            @php
                $additionalImages = session('additional_images_temp', []);
            @endphp
            @for ($i = 0; $i < 3; $i++)
                <div class="thumbnail">
                    <img 
                        src="{{ isset($additionalImages[$i]) ? Storage::url($additionalImages[$i]) : asset('img/administration/placeholder.png') }}" 
                        alt="Additional Image {{ $i + 1 }}" 
                        class="additional-image-preview"
                        id="additional-image-preview-{{ $i }}"
                    >
                </div>
                @endfor
                </div>
                <input 
                    class="browse-button" 
                    type="file" 
                    id="additional-images" 
                    name="additional_images[]" 
                    multiple 
                    onchange="previewAdditionalImages(event, {{ count($additionalImages) }})"
                >
                @if ($errors->has('additional_images.*'))
                    <div class="text-danger">{{ $errors->first('additional_images.*') }}</div>
                @endif
                <input type="hidden" name="additional_images_temp[]" value="{{ json_encode($additionalImages) }}">
        </div>
    </div>

            </div>
            <div class="form-container">
            <section class="car-form">
               <!-- Left Section -->
                <section class="left-side">
                    <div class="form-group">
                        <label for="make">Make:</label>
                        <input type="text" id="make" name="make" value="{{ old('make') }}" placeholder="Select the make of the car">
                        @error('make')
                            <div class="error_field">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="model">Model:</label>
                        <input type="text" id="model" name="model" value="{{ old('model') }}" placeholder="Select the model of the car">
                        @error('model')
                            <div class="error_field">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="year">Year:</label>
                        <input type="number" id="year" name="year" value="{{ old('year') }}" placeholder="Select the year of the car">
                        @error('year')
                            <div class="error_field">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="type">Type:</label>
                        <select id="type" name="type">
                            <option value="SUV" {{ old('type') == 'SUV' ? 'selected' : '' }}>SUV</option>
                            <option value="SEDAN" {{ old('type') == 'SEDAN' ? 'selected' : '' }}>SEDAN</option>
                            <option value="Coupe" {{ old('type') == 'Coupe' ? 'selected' : '' }}>Coupe</option>
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
                        <input type="number" id="mileage" name="mileage" value="{{ old('mileage') }}" placeholder="Integer only, ex: (150000)">
                        @error('mileage')
                            <div class="error_field">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="fuel-efficiency">Fuel Efficiency (Per 100 km):</label>
                        <input type="number" id="fuel-efficiency" name="fuel_efficiency" value="{{ old('fuel_efficiency') }}" placeholder="Integer only, ex: (9.5)" step="0.1">
                        @error('fuel_efficiency')
                            <div class="error_field">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="engine-size">Engine Size:</label>
                        <input type="number" id="engine-size" name="engine_size" value="{{ old('engine_size') }}" placeholder="Integer only, ex: (2.5)" step="0.1">
                        @error('engine_size')
                            <div class="error_field">{{ $message }}</div>
                        @enderror
                    </div>
                </section>

                <!-- Right Section -->
                <section class="right-side">
                    <div class="form-group">
                        <label for="horsepower">Horsepower:</label>
                        <input type="number" id="horsepower" name="horsepower" value="{{ old('horsepower') }}" placeholder="Integer only, ex: (150)">
                        @error('horsepower')
                            <div class="error_field">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" id="price" name="price" value="{{ old('price') }}" placeholder="Integer only, ex: (12000)">
                        @error('price')
                            <div class="error_field">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="vin">VIN:</label>
                        <input type="text" id="vin" name="vin" value="{{ old('vin') }}" placeholder="ex: 1VXBR12EXCP901213">
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
                        <input type="number" id="seat-capacity" name="seat_capacity" value="{{ old('seat_capacity') }}" placeholder="Integer only, ex: (5)">
                        @error('seat_capacity')
                            <div class="error_field">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="drive-type">Drive Type:</label>
                        <select id="drive-type" name="drive_type">
                            <option value="FWD" {{ old('drive_type') == 'FWD' ? 'selected' : '' }}>FWD</option>
                            <option value="RWD" {{ old('drive_type') == 'RWD' ? 'selected' : '' }}>RWD</option>
                            <option value="AWD" {{ old('drive_type') == 'AWD' ? 'selected' : '' }}>AWD</option>
                            <option value="4WD" {{ old('drive_type') == '4WD' ? 'selected' : '' }}>4WD</option>
                        </select>
                        @error('drive_type')
                            <div class="error_field">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="car-condition">Car Condition:</label>
                        <select id="car-condition" name="car_condition">
                            <option value="New" {{ old('car_condition') == 'New' ? 'selected' : '' }}>New</option>
                            <option value="Used" {{ old('car_condition') == 'Used' ? 'selected' : '' }}>Used</option>
                            <option value="Certified" {{ old('car_condition') == 'Certified' ? 'selected' : '' }}>Certified</option>
                        </select>
                        @error('car_condition')
                            <div class="error_field">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="submit-button">Create The Car</button>
                </section>

            </section>

            </div>
        </form>
    </section>
</main>


<script>
    // Preview main image
    function previewImage(event, previewId) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById(previewId).src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    // Preview additional images
    function previewAdditionalImages(event, maxCount) {
        const files = event.target.files;
        for (let i = 0; i < Math.min(files.length, maxCount); i++) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const previewId = `additional-image-preview-${i}`;
                const imgElement = document.getElementById(previewId);
                if (imgElement) {
                    imgElement.src = e.target.result;
                }
            };
            reader.readAsDataURL(files[i]);
        }
    }
</script>


@endsection