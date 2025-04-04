<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
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
}


?>