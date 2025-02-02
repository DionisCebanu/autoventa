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
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create the car
        $car = Car::create($request->all());

        // Handle the main image upload
    if ($request->hasFile('main_image')) {
        $mainImagePath = $request->file('main_image')->store('cars/main_images', 'public');
        session(['main_image_temp' => $mainImagePath]);

        Image::create([
            'car_id' => $car->id,
            'image_path' => $mainImagePath,
            'is_main' => true,
        ]);
    }

    // Handle additional images upload
    $additionalImages = [];
    if ($request->hasFile('additional_images')) {
        foreach ($request->file('additional_images') as $image) {
            $additionalImagePath = $image->store('cars/additional_images', 'public');
            $additionalImages[] = $additionalImagePath; // Add to the array

            Image::create([
                'car_id' => $car->id,
                'image_path' => $additionalImagePath,
                'is_main' => false,
            ]);
             }
             session(['additional_images_temp' => $additionalImages]); // Use the correct variable
        }
        // Clear the session data for temporary images
        session()->forget(['main_image_temp', 'additional_images_temp']);
        // Redirect with a success message
        return redirect()->route('car.index')->with('success', 'Car created successfully with images!');
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


}
