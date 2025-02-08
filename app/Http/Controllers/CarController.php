<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Show the car creation form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('car.create');
    }

    /**
     * Store a new car in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'type' => 'required|in:SUV,SEDAN,Coupe',
            'transmission' => 'required|in:Automatic,Manual',
            'fuel_type' => 'required|in:Diesel,Petrol,Hybrid,Electric',
            'mileage' => 'required|integer',
            'fuel_efficiency' => 'required|numeric',
            'engine_size' => 'required|numeric',
            'horsepower' => 'required|integer',
            'price' => 'required|numeric',
            'vin' => 'required|string|max:17|unique:cars,vin',
            'availability_status' => 'required|in:Sold,Available,Coming,Reserved',
            'seat_capacity' => 'required|integer',
            'drive_type' => 'required|in:FWD,RWD,AWD,4WD',
            'car_condition' => 'required|in:New,Used,Certified',
            'main_image_url' => 'required|url',
            'additional_images_urls.*' => 'nullable|url', 
        ]);

        // Create the car
        $car = Car::create($request->all());

        // Convert main image link to a direct Google Drive link
        $mainImageUrl = $this->convertGoogleDriveLink($request->main_image_url);

        Image::create([
            'car_id' => $car->id,
            'image_path' => $mainImageUrl,
            'is_main' => true,
        ]);


        // Handle additional images upload
        if ($request->has('additional_images_urls')) {
            foreach ($request->additional_images_urls as $imageUrl) {
                $convertedImageUrl = $this->convertGoogleDriveLink($imageUrl);
    
                Image::create([
                    'car_id' => $car->id,
                    'image_path' => $convertedImageUrl,
                    'is_main' => false,
                ]);
            }
        }
            // Redirect with a success message
            return redirect()->route('car.index')->with('success', 'Car created successfully with images!');
    }


    public function edit($id)
    {
        // Retrieve the car by ID with its images
        $car = Car::with('images')->findOrFail($id);

        // Return the edit view with the car and images
        return view('car.edit', compact('car'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'type' => 'required|in:SUV,SEDAN,Coupe',
            'transmission' => 'required|in:Automatic,Manual',
            'fuel_type' => 'required|in:Diesel,Petrol,Hybrid,Electric',
            'mileage' => 'required|integer',
            'fuel_efficiency' => 'required|numeric',
            'engine_size' => 'required|numeric',
            'horsepower' => 'required|integer',
            'price' => 'required|numeric',
            'vin' => 'required|string|max:17|unique:cars,vin,' . $id,
            'availability_status' => 'required|in:Sold,Available,Coming,Reserved',
            'seat_capacity' => 'required|integer',
            'drive_type' => 'required|in:FWD,RWD,AWD,4WD',
            'car_condition' => 'required|in:New,Used,Certified',
            'main_image_url' => 'required|url',
            'additional_images_urls.*' => 'nullable|url',
        ]);

        // Find the car
        $car = Car::findOrFail($id);

        // Update the car details
        $car->update($request->all());

        // Update the main image
        $mainImageUrl = $this->convertGoogleDriveLink($request->main_image_url);
        $mainImage = $car->images()->where('is_main', true)->first();

        if ($mainImage) {
            // Update the existing main image
            $mainImage->update(['image_path' => $mainImageUrl]);
        } else {
            // Create a new main image if none exists
            Image::create([
                'car_id' => $car->id,
                'image_path' => $mainImageUrl,
                'is_main' => true,
            ]);
        }

        // Update additional images
        if ($request->has('additional_images_urls')) {
            // Delete old additional images
            $car->images()->where('is_main', false)->delete();

            // Add new additional images
            foreach ($request->additional_images_urls as $imageUrl) {
                $convertedImageUrl = $this->convertGoogleDriveLink($imageUrl);

                Image::create([
                    'car_id' => $car->id,
                    'image_path' => $convertedImageUrl,
                    'is_main' => false,
                ]);
            }
        }

        // Redirect with a success message
        return redirect()->route('car.index')->with('success', 'Car updated successfully with images!');
    }




    /**
     * List all the cars
     */
    public function index()
    {
        // Retrieve all cars with their main images
        $cars = Car::with(['images' => function ($query) {
            $query->where('is_main', true);
        }])->get();

        // Return the index view with the cars
        return view('car.index', compact('cars'));
    }


    /**
     * Car show
     */

     public function show($id)
    {
        // Retrieve the car by ID with its images
        $car = Car::with('images')->findOrFail($id);

        // Pass the car to the view
        return view('car.show', compact('car'));    
    }



    /**
 * Convert a Google Drive share link into a direct image URL.
 */
    private function convertGoogleDriveLink($url)
    {
        if (preg_match('/drive\.google\.com\/file\/d\/([^\/]+)/', $url, $matches)) {
            return "https://drive.google.com/thumbnail?id={$matches[1]}&sz=w1000";
        }
        return $url; // Return original URL if it's already a direct link
    }

}
