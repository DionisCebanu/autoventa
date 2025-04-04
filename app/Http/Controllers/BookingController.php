<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Booking;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{


    /**
     * Perform your actions (schedule, bookings, etc)
     */
    public function home() {
        return view('administration.bookings.home');
    }

    /**
     * Get available solts
     */
    public function getAvailableSlots(Request $request)
    {
        $date = $request->query('date');

        if (!$date) {
            return response()->json(['error' => 'Date is required'], 400);
        }

        // Step 1: Get all booked times for this date
        $bookedTimes = Booking::where('date', $date)
            ->pluck('start_time')
            ->map(fn($time) => substr($time, 0, 5)) // trim to "HH:MM"
            ->toArray();

        // Step 2: Get scheduled available slots for this date
        $slots = Schedule::where('date', $date)
            ->select('start_time', 'end_time')
            ->orderBy('start_time')
            ->get()
            ->flatMap(function ($slot) use ($bookedTimes) {
                // break each slot into 30-min intervals
                $start = substr($slot->start_time, 0, 5);
                $end = substr($slot->end_time, 0, 5);

                return $this->generateIntervals($start, $end)
                    ->filter(fn($time) => !in_array($time, $bookedTimes))
                    ->map(fn($time) => ['start' => $time]);
            })
            ->values();

        return response()->json($slots);
    }


    /**
     * Generate intevals
     */
    private function generateIntervals($start, $end)
    {
        $intervals = collect();

        [$startHour, $startMinute] = explode(':', $start);
        [$endHour, $endMinute] = explode(':', $end);

        $startHour = (int) $startHour;
        $startMinute = (int) $startMinute;
        $endHour = (int) $endHour;
        $endMinute = (int) $endMinute;

        while ($startHour < $endHour || ($startHour === $endHour && $startMinute <= $endMinute)) {
            $formatted = sprintf('%02d:%02d', $startHour, $startMinute);
            $intervals->push($formatted);

            $startMinute += 30;
            if ($startMinute >= 60) {
                $startMinute = 0;
                $startHour++;
            }
        }

        return $intervals;
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

    /**
     * List the bookings
     */
    public function listBookings()
    {
        $bookings = Booking::with('car')->latest()->get();

        return view('administration.bookings.index', compact('bookings'));
    }
}


?>