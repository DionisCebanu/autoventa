<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Booking;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    /**
     * Get available solts
     */
    public function getAvailableSlots(Request $request)
    {
        $date = $request->query('date');
    
        if (!$date) {
            return response()->json(['error' => 'Date is required'], 400);
        }
    
        // Example: fetch slots from 'schedules' table for that day
        $slots = Schedule::where('date', $date)
            ->select('start_time', 'end_time')
            ->orderBy('start_time')
            ->get()
            ->map(fn($slot) => [
                'start' => substr($slot->start_time, 0, 5),
                'end' => substr($slot->end_time, 0, 5)
            ]);
    
        return response()->json($slots);
    }    

    /**
     * Store the booking
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|string|max:30',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
        ]);

        Booking::create($validated);

        return redirect()->back()->with('success', 'Booking confirmed!');
    }
}


?>